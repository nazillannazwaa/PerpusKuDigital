<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Public Landing Page
Route::get('/', function () {
    $popularBooks = \App\Models\Book::withCount('loans')
        ->orderByDesc('loans_count')
        ->latest()
        ->take(4)
        ->get();

    $totalBooks = \App\Models\Book::count();
    $totalStock = (int) \App\Models\Book::sum('stock');
    $totalMembers = \App\Models\User::where('role', 'user')->count();

    return view('landing', compact('popularBooks', 'totalBooks', 'totalStock', 'totalMembers'));
})->name('landing');

Route::get('/landing', function () {
    return redirect()->route('landing');
});

// Guest Auth Routes (Clean Standard Login & Register)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Protected Routes (Dashboard & Perpustakaan)
Route::middleware('auth')->group(function () {
    // Single Unified Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', function () {
        return redirect()->route('dashboard');
    });

    // Book Management (CRUD)
    Route::post('/books', [DashboardController::class, 'storeBook'])->name('books.store');
    Route::put('/books/{book}', [DashboardController::class, 'updateBook'])->name('books.update');
    Route::delete('/books/{book}', [DashboardController::class, 'destroyBook'])->name('books.destroy');

    // Loans (Borrow & Return Requests)
    Route::post('/loans/borrow', [DashboardController::class, 'borrow'])->name('loans.borrow');
    Route::post('/loans/{loan}/return-request', [DashboardController::class, 'returnRequest'])->name('loans.return-request');

    // Loan Approvals (Admin)
    Route::post('/loans/{loan}/approve', [DashboardController::class, 'approveLoan'])->name('loans.approve');
    Route::post('/loans/{loan}/reject', [DashboardController::class, 'rejectLoan'])->name('loans.reject');
    Route::post('/loans/{loan}/approve-return', [DashboardController::class, 'approveReturn'])->name('loans.approve-return');

    // Profile Management
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
