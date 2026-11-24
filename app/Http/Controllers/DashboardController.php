<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    /**
     * Categories list for book management.
     */
    protected array $categories = [
        'Fiksi',
        'Filsafat',
        'Sejarah',
        'Teknologi',
        'Pengembangan Diri',
        'Sains',
        'Agama',
        'Biografi',
        'Komik & Grafis',
        'Umum',
    ];

    /**
     * Unified Dashboard for both Admin & Student.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->isAdmin();

        // 1. All Books from Database
        $books = Book::latest()->get();

        $booksJson = $books->map(function ($b) {
            return [
                'id' => $b->id,
                'title' => $b->title,
                'author' => $b->author,
                'code' => $b->code,
                'category' => $b->category,
                'stock' => $b->stock,
                'cover' => $b->cover_url,
                'description' => $b->description,
            ];
        });

        // 2. Admin specific data
        $adminStats = [];
        $pendingLoans = collect();
        $pendingReturns = collect();
        $activeLoans = collect();
        $returnedLoans = collect();

        if ($isAdmin) {
            $adminStats = [
                'total_books' => Book::count(),
                'total_stock' => Book::sum('stock'),
                'pending_loans' => Loan::where('status', 'pending')->count(),
                'pending_returns' => Loan::where('status', 'pending_return')->count(),
                'active_loans' => Loan::where('status', 'active')->count(),
                'returned_loans' => Loan::where('status', 'returned')->count(),
            ];

            $allLoans = Loan::with(['user', 'book'])->latest()->get();
            $pendingLoans = $allLoans->where('status', 'pending');
            $pendingReturns = $allLoans->where('status', 'pending_return');
            $activeLoans = $allLoans->where('status', 'active');
            $returnedLoans = $allLoans->where('status', 'returned');

            // For Admin: view all active/pending-return loans and all returned/rejected loans
            $loansData = Loan::with(['book', 'user'])
                ->whereIn('status', ['active', 'pending_return'])
                ->latest()
                ->get();

            $historyData = Loan::with(['book', 'user'])
                ->whereIn('status', ['returned', 'rejected'])
                ->latest()
                ->get();
        } else {
            // For Regular Student: only their own loans
            $loansData = Loan::with(['book', 'user'])
                ->where('user_id', $user->id)
                ->whereIn('status', ['pending', 'active', 'pending_return'])
                ->latest()
                ->get();

            $historyData = Loan::with(['book', 'user'])
                ->where('user_id', $user->id)
                ->whereIn('status', ['returned', 'rejected'])
                ->latest()
                ->get();
        }

        // Formatted loans for client-side table rendering
        $formattedLoans = $loansData->map(function ($l) {
            return [
                'id' => $l->id,
                'bookId' => $l->book_id,
                'title' => $l->book ? $l->book->title : 'Buku Tidak Tersedia',
                'author' => $l->book ? $l->book->author : '-',
                'code' => $l->book ? $l->book->code : '-',
                'cover' => $l->book ? $l->book->cover_url : '',
                'userName' => $l->user ? $l->user->name : 'Siswa',
                'userEmail' => $l->user ? $l->user->email : '',
                'status' => $l->status,
                'borrow_date' => $l->borrow_date ? $l->borrow_date->format('d M Y') : ($l->created_at ? $l->created_at->format('d M Y') : '-'),
                'due_date' => $l->due_date ? $l->due_date->format('d M Y') : '-',
                'from' => $l->borrow_date ? $l->borrow_date->toISOString() : null,
                'due' => $l->due_date ? $l->due_date->toISOString() : null,
            ];
        });

        // Formatted history for client-side table rendering
        $formattedHistory = $historyData->map(function ($h) {
            return [
                'id' => $h->id,
                'title' => $h->book ? $h->book->title : 'Buku Tidak Tersedia',
                'code' => $h->book ? $h->book->code : '-',
                'cover' => $h->book ? $h->book->cover_url : '',
                'userName' => $h->user ? $h->user->name : 'Siswa',
                'userEmail' => $h->user ? $h->user->email : '',
                'status' => $h->status,
                'from' => $h->borrow_date ? $h->borrow_date->format('d M Y') : ($h->created_at ? $h->created_at->format('d M Y') : '-'),
                'to' => $h->return_date ? $h->return_date->format('d M Y') : ($h->updated_at ? $h->updated_at->format('d M Y') : '-'),
                'late' => 0,
            ];
        });

        // 5. Overview Metrics matching screenshot layout
        $overviewStats = [
            'total_books' => Book::count(),
            'borrowed_books' => Loan::whereIn('status', ['active', 'pending_return'])->count(),
            'available_books' => (int) Book::sum('stock'),
            'total_members' => \App\Models\User::where('role', 'user')->count(),
        ];

        // 6. Popular & Recent Books from Database
        $popularBooks = Book::withCount('loans')
            ->orderByDesc('loans_count')
            ->latest()
            ->take(5)
            ->get();

        $recentBooks = Book::latest()
            ->take(4)
            ->get();

        // 7. Recent Activities (Formatted nicely)
        $activitiesQuery = Loan::with(['book', 'user'])->latest();
        if (!$isAdmin) {
            $userActivities = (clone $activitiesQuery)->where('user_id', $user->id)->take(6)->get();
            $recentActivities = $userActivities->isNotEmpty() ? $userActivities : $activitiesQuery->take(6)->get();
        } else {
            $recentActivities = $activitiesQuery->take(6)->get();
        }

        return view('dashboard', [
            'user' => $user,
            'isAdmin' => $isAdmin,
            'dbBooks' => $booksJson,
            'books' => $books,
            'dbLoans' => $formattedLoans,
            'dbHistory' => $formattedHistory,
            'adminStats' => $adminStats,
            'pendingLoans' => $pendingLoans,
            'pendingReturns' => $pendingReturns,
            'activeLoans' => $activeLoans,
            'returnedLoans' => $returnedLoans,
            'categories' => $this->categories,
            'overviewStats' => $overviewStats,
            'popularBooks' => $popularBooks,
            'recentBooks' => $recentBooks,
            'recentActivities' => $recentActivities,
        ]);
    }

    /**
     * Store new book (Admin).
     */
    public function storeBook(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat menambah buku.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:books,code',
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'cover_url' => 'nullable|url|max:1000',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'Judul buku wajib diisi.',
            'author.required' => 'Penulis buku wajib diisi.',
            'code.required' => 'Kode buku wajib diisi.',
            'code.unique' => 'Kode buku sudah digunakan.',
            'stock.required' => 'Jumlah stok buku wajib diisi.',
            'cover_image.image' => 'File cover harus berupa gambar.',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $destination = public_path('uploads/covers');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file = $request->file('cover_image');
            $fileName = 'book_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $fileName);
            $coverPath = 'uploads/covers/' . $fileName;
        } elseif ($request->filled('cover_url')) {
            $coverPath = $request->input('cover_url');
        }

        Book::create([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'code' => strtoupper($validated['code']),
            'category' => $validated['category'],
            'stock' => (int) $validated['stock'],
            'cover' => $coverPath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->to(route('dashboard') . '#katalog')
            ->with('status', 'Buku baru "' . $validated['title'] . '" berhasil ditambahkan ke katalog!');
    }

    /**
     * Update existing book (Admin).
     */
    public function updateBook(Request $request, Book $book)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat mengedit buku.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:books,code,' . $book->id,
            'category' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'cover_url' => 'nullable|url|max:1000',
            'description' => 'nullable|string',
        ]);

        $coverPath = $book->cover;
        if ($request->hasFile('cover_image')) {
            if ($book->cover && str_starts_with($book->cover, 'uploads/covers/') && file_exists(public_path($book->cover))) {
                @unlink(public_path($book->cover));
            }
            $destination = public_path('uploads/covers');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file = $request->file('cover_image');
            $fileName = 'book_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($destination, $fileName);
            $coverPath = 'uploads/covers/' . $fileName;
        } elseif ($request->filled('cover_url')) {
            $coverPath = $request->input('cover_url');
        }

        $book->update([
            'title' => $validated['title'],
            'author' => $validated['author'],
            'code' => strtoupper($validated['code']),
            'category' => $validated['category'],
            'stock' => (int) $validated['stock'],
            'cover' => $coverPath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->to(route('dashboard') . '#katalog')
            ->with('status', 'Data buku "' . $book->title . '" berhasil diperbarui!');
    }

    /**
     * Delete book (Admin).
     */
    public function destroyBook(Book $book)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat menghapus buku.');
        }

        $title = $book->title;
        if ($book->cover && str_starts_with($book->cover, 'uploads/covers/') && file_exists(public_path($book->cover))) {
            @unlink(public_path($book->cover));
        }

        $book->delete();

        return redirect()->to(route('dashboard') . '#katalog')
            ->with('status', 'Buku "' . $title . '" berhasil dihapus dari perpustakaan.');
    }

    /**
     * Approve borrow (Admin).
     */
    public function approveLoan(Loan $loan)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Akses khusus admin.');
        }

        if ($loan->status !== 'pending') {
            return back()->with('error', 'Status peminjaman ini bukan pending.');
        }

        $book = $loan->book;
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku "' . $book->title . '" saat ini habis (0)!');
        }

        $book->decrement('stock');
        $loan->update([
            'status' => 'active',
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
        ]);

        return redirect()->to(route('dashboard') . '#peminjaman')
            ->with('status', 'Peminjaman buku "' . $book->title . '" oleh ' . $loan->user->name . ' BERHASIL DISETUJUI. Batas kembali 7 hari.');
    }

    /**
     * Reject borrow (Admin).
     */
    public function rejectLoan(Request $request, Loan $loan)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Akses khusus admin.');
        }

        $loan->update([
            'status' => 'rejected',
            'notes' => $request->input('notes', 'Ditolak oleh admin.'),
        ]);

        return redirect()->to(route('dashboard') . '#peminjaman')
            ->with('status', 'Peminjaman buku "' . $loan->book->title . '" telah DITOLAK.');
    }

    /**
     * Approve return (Admin).
     */
    public function approveReturn(Loan $loan)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Akses khusus admin.');
        }

        $loan->book->increment('stock');
        $loan->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        return redirect()->to(route('dashboard') . '#pengembalian')
            ->with('status', 'Pengembalian buku "' . $loan->book->title . '" oleh ' . $loan->user->name . ' BERHASIL DISETUJUI! (+1 Stok).');
    }

    /**
     * Student borrow request.
     */
    public function borrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->input('book_id'));
        $user = Auth::user();

        if ($book->stock <= 0) {
            return back()->with('error', 'Maaf, stok buku "' . $book->title . '" saat ini sedang habis.');
        }

        $existing = Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'active', 'pending_return'])
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah meminjam atau sedang mengajukan peminjaman buku ini.');
        }

        Loan::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
            'notes' => 'Menunggu persetujuan admin',
        ]);

        return redirect()->to(route('dashboard') . '#peminjaman')
            ->with('status', 'Permintaan peminjaman buku "' . $book->title . '" berhasil diajukan! Menunggu persetujuan Admin.');
    }

    /**
     * Student request return.
     */
    public function returnRequest(Loan $loan)
    {
        $user = Auth::user();

        if ($loan->user_id !== $user->id && !$user->isAdmin()) {
            return back()->with('error', 'Akses tidak sah.');
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        return redirect()->to(route('dashboard') . '#pengembalian')
            ->with('status', 'Pengajuan pengembalian buku "' . $loan->book->title . '" telah dikirim ke Admin untuk disetujui.');
    }

    /**
     * Update user profile (name, avatar photo, and optional password).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'avatar_url' => 'nullable|string|url|max:500',
            'password' => 'nullable|string|min:4|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'avatar_file.image' => 'File foto profil harus berupa gambar.',
            'avatar_file.max' => 'Ukuran foto profil maksimal 5MB.',
            'password.min' => 'Kata sandi minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $destinationPath = public_path('uploads/avatars');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);
            $user->avatar = 'uploads/avatars/' . $filename;
        } elseif ($request->filled('avatar_url')) {
            $user->avatar = $request->input('avatar_url');
        }

        $user->name = $request->input('name');

        if ($request->filled('password')) {
            $user->password = $request->input('password'); // hashed automatically by cast
        }

        $user->save();

        return redirect()->to(route('dashboard') . '#profil')
            ->with('status', 'Profil berhasil diperbarui!');
    }
}

