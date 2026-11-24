<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Show student library dashboard with real DB data.
     */
    public function index()
    {
        $user = Auth::user();

        // Redirect admin directly to admin panel if they prefer
        // But also let them view user dashboard if requested
        $books = Book::all()->map(function ($b) {
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

        // User's active or pending loans
        $userLoans = Loan::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['pending', 'active', 'pending_return'])
            ->latest()
            ->get()
            ->map(function ($l) {
                return [
                    'id' => $l->id,
                    'bookId' => $l->book_id,
                    'title' => $l->book->title,
                    'author' => $l->book->author,
                    'code' => $l->book->code,
                    'cover' => $l->book->cover_url,
                    'status' => $l->status,
                    'borrow_date' => $l->borrow_date ? $l->borrow_date->format('d M Y') : '-',
                    'due_date' => $l->due_date ? $l->due_date->format('d M Y') : '-',
                    'from' => $l->borrow_date ? $l->borrow_date->toISOString() : null,
                    'due' => $l->due_date ? $l->due_date->toISOString() : null,
                ];
            });

        // User's history (returned or rejected)
        $userHistory = Loan::with('book')
            ->where('user_id', $user->id)
            ->whereIn('status', ['returned', 'rejected'])
            ->latest()
            ->get()
            ->map(function ($h) {
                return [
                    'id' => $h->id,
                    'title' => $h->book->title,
                    'code' => $h->book->code,
                    'cover' => $h->book->cover_url,
                    'status' => $h->status,
                    'from' => $h->borrow_date ? $h->borrow_date->format('d M Y') : '-',
                    'to' => $h->return_date ? $h->return_date->format('d M Y') : ($h->updated_at ? $h->updated_at->format('d M Y') : '-'),
                    'late' => 0,
                ];
            });

        return view('dashboard', [
            'dbBooks' => $books,
            'dbLoans' => $userLoans,
            'dbHistory' => $userHistory,
        ]);
    }

    /**
     * Student request to borrow a book.
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

        // Check if student already has an active or pending loan for this book
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

        return back()->with('status', 'Permintaan peminjaman buku "' . $book->title . '" berhasil diajukan! Menunggu persetujuan Admin.');
    }

    /**
     * Student request to return a borrowed book.
     */
    public function returnRequest(Loan $loan)
    {
        $user = Auth::user();

        if ($loan->user_id !== $user->id) {
            return back()->with('error', 'Akses tidak sah.');
        }

        if ($loan->status !== 'active') {
            return back()->with('error', 'Buku ini tidak dalam status pinjaman aktif.');
        }

        $loan->update([
            'status' => 'pending_return',
        ]);

        return back()->with('status', 'Pengajuan pengembalian buku "' . $loan->book->title . '" telah dikirim ke Admin untuk disetujui.');
    }
}

