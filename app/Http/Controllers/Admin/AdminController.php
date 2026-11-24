<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Categories list
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
     * Admin Dashboard & Management Hub.
     */
    public function index(Request $request)
    {
        // 1. Stats Summary
        $stats = [
            'total_books' => Book::count(),
            'total_stock' => Book::sum('stock'),
            'pending_loans' => Loan::where('status', 'pending')->count(),
            'pending_returns' => Loan::where('status', 'pending_return')->count(),
            'active_loans' => Loan::where('status', 'active')->count(),
            'returned_loans' => Loan::where('status', 'returned')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        // 2. Books query with search & filter
        $booksQuery = Book::latest();
        if ($request->filled('q')) {
            $q = $request->query('q');
            $booksQuery->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('author', 'like', "%{$q}%")
                      ->orWhere('code', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category')) {
            $booksQuery->where('category', $request->query('category'));
        }
        $books = $booksQuery->get();

        // 3. Loans list
        $allLoans = Loan::with(['user', 'book'])->latest()->get();
        $pendingLoans = $allLoans->where('status', 'pending');
        $activeLoans = $allLoans->where('status', 'active');
        $pendingReturns = $allLoans->where('status', 'pending_return');
        $returnedLoans = $allLoans->where('status', 'returned');

        return view('admin.dashboard', [
            'stats' => $stats,
            'books' => $books,
            'pendingLoans' => $pendingLoans,
            'activeLoans' => $activeLoans,
            'pendingReturns' => $pendingReturns,
            'returnedLoans' => $returnedLoans,
            'categories' => $this->categories,
            'selectedCategory' => $request->query('category', ''),
            'searchQuery' => $request->query('q', ''),
        ]);
    }

    /**
     * Store a newly created book.
     */
    public function storeBook(Request $request)
    {
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
            'code.unique' => 'Kode buku sudah digunakan, pilih kode lain.',
            'stock.required' => 'Jumlah stok buku wajib diisi.',
            'stock.min' => 'Stok buku minimal 0.',
            'cover_image.image' => 'File cover harus berupa gambar (jpg, png, webp).',
            'cover_image.max' => 'Ukuran gambar maksimal 4 MB.',
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

        return redirect()->route('admin.dashboard', ['tab' => 'buku'])
            ->with('status', 'Buku baru "' . $validated['title'] . '" berhasil ditambahkan ke katalog!');
    }

    /**
     * Update existing book.
     */
    public function updateBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:books,code,' . $book->id,
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

        $coverPath = $book->cover;

        if ($request->hasFile('cover_image')) {
            // Delete old file if local
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

        return redirect()->route('admin.dashboard', ['tab' => 'buku'])
            ->with('status', 'Data buku "' . $book->title . '" berhasil diperbarui!');
    }

    /**
     * Delete a book.
     */
    public function destroyBook(Book $book)
    {
        $title = $book->title;

        // Delete uploaded cover file if exists
        if ($book->cover && str_starts_with($book->cover, 'uploads/covers/') && file_exists(public_path($book->cover))) {
            @unlink(public_path($book->cover));
        }

        $book->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'buku'])
            ->with('status', 'Buku "' . $title . '" berhasil dihapus dari perpustakaan.');
    }

    /**
     * Approve a book loan.
     */
    public function approveLoan(Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Status peminjaman ini bukan pending.');
        }

        $book = $loan->book;
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku "' . $book->title . '" saat ini habis (0), tidak dapat disetujui!');
        }

        // Decrement stock
        $book->decrement('stock');

        // Update loan
        $loan->update([
            'status' => 'active',
            'borrow_date' => now(),
            'due_date' => now()->addDays(7), // Batas pinjam 7 hari
        ]);

        return back()->with('status', 'Peminjaman buku "' . $book->title . '" oleh ' . $loan->user->name . ' BERHASIL DISETUJUI. Batas pengembalian 7 hari.');
    }

    /**
     * Reject a book loan.
     */
    public function rejectLoan(Request $request, Loan $loan)
    {
        if ($loan->status !== 'pending') {
            return back()->with('error', 'Peminjaman ini sudah diproses.');
        }

        $loan->update([
            'status' => 'rejected',
            'notes' => $request->input('notes', 'Ditolak oleh admin.'),
        ]);

        return back()->with('status', 'Peminjaman buku "' . $loan->book->title . '" oleh ' . $loan->user->name . ' telah DITOLAK.');
    }

    /**
     * Approve book return.
     */
    public function approveReturn(Loan $loan)
    {
        if (!in_array($loan->status, ['active', 'pending_return'])) {
            return back()->with('error', 'Peminjaman ini tidak dalam status aktif atau menunggu pengembalian.');
        }

        // Increment stock back
        $loan->book->increment('stock');

        $loan->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        return back()->with('status', 'Pengembalian buku "' . $loan->book->title . '" oleh ' . $loan->user->name . ' BERHASIL DISETUJUI! Stok buku bertambah kembali.');
    }
}

