<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Default Admin credentials
     */
    protected string $adminUsername = 'admin';
    protected string $adminPassword = 'adminperpus123';
    protected string $adminEmail = 'admin@perpusku.id';

    /**
     * Show login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login', [
            'defaultAdminUsername' => env('ADMIN_USERNAME', $this->adminUsername),
            'defaultAdminPassword' => env('ADMIN_PASSWORD', $this->adminPassword),
        ]);
    }

    /**
     * Unified Login for Admin & Students.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Email atau Username wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $inputLogin = trim($credentials['login']);
        $inputPassword = $credentials['password'];
        $remember = $request->boolean('remember', true);

        $expectedAdminUser = env('ADMIN_USERNAME', $this->adminUsername);
        $expectedAdminPass = env('ADMIN_PASSWORD', $this->adminPassword);
        $expectedAdminEmail = env('ADMIN_EMAIL', $this->adminEmail);

        // 1. Check if logging in as Admin
        if (($inputLogin === $expectedAdminUser || $inputLogin === $expectedAdminEmail) && $inputPassword === $expectedAdminPass) {
            $adminUser = User::firstOrCreate(
                ['email' => $expectedAdminEmail],
                [
                    'name' => 'Administrator PerpusKu',
                    'password' => Hash::make($expectedAdminPass),
                    'role' => 'admin',
                    'avatar' => 'https://ui-avatars.com/api/?name=Admin+PerpusKu&background=0f6b5c&color=ffffff',
                ]
            );

            if (!Hash::check($expectedAdminPass, $adminUser->password)) {
                $adminUser->password = Hash::make($expectedAdminPass);
                $adminUser->save();
            }

            Auth::login($adminUser, $remember);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))
                ->with('status', 'Selamat Datang Admin PerpusKu');
        }

        // 2. Check if logging in as Student / Registered User
        $user = User::where('email', strtolower($inputLogin))
            ->orWhere('name', $inputLogin)
            ->first();

        if ($user) {
            // Check password if set
            if ($user->password && Hash::check($inputPassword, $user->password)) {
                Auth::login($user, $remember);
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'))
                    ->with('status', 'Selamat datang kembali, ' . $user->name . '!');
            }

            // If account was created without password previously, allow login and update password
            if ($user->password === null) {
                $user->password = Hash::make($inputPassword);
                $user->save();

                Auth::login($user, $remember);
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'))
                    ->with('status', 'Selamat datang, ' . $user->name . '! Kata sandi Anda telah disimpan.');
            }
        }

        return back()->withInput()->withErrors([
            'login_error' => 'Email/Username atau Kata Sandi tidak sesuai. Silakan coba lagi atau daftar akun baru.',
        ]);
    }

    /**
     * Register new student account.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan langsung login di tab Masuk.',
            'password.required' => 'Kata sandi wajib dibuat.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
        ]);

        $user = User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(trim($validated['name'])) . '&background=0f6b5c&color=ffffff',
        ]);

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('status', 'Pendaftaran berhasil! Selamat datang di PerpusKu, ' . $user->name . '!');
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing')->with('status', 'Anda telah berhasil keluar.');
    }
}
