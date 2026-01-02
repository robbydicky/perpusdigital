<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    // Proses Peminjaman Buku
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        // 1. Cek apakah stok masih ada
        if ($book->stock < 1) {
            return back()->with('error', 'Maaf, stok buku ini sedang habis.');
        }

        // 2. Cek apakah user sedang meminjam buku yang sama dan belum dikembalikan (Opsional)
        $existingLoan = Loan::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->where('status', 'borrowed')
            ->exists();

        if ($existingLoan) {
            return back()->with('error', 'Anda masih meminjam buku ini.');
        }

        // 3. Kurangi Stok Buku
        $book->decrement('stock');

        // 4. Catat Peminjaman
        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'loan_date' => now(),
            'return_date' => now()->addDays(7), // Default pinjam 7 hari
            'status' => 'borrowed',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam! Silakan ambil di perpustakaan.');
    }

    // Halaman daftar buku yang sedang dipinjam user
    public function index()
    {
        $loans = Loan::with('book')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.loans', compact('loans'));
    }
}