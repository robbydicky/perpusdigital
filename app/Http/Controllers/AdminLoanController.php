<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminLoanController extends Controller
{
    // Halaman daftar semua peminjaman
    public function index()
    {
        // Ambil data peminjaman, urutkan yang statusnya 'borrowed' paling atas
        $loans = Loan::with(['user', 'book'])
            ->orderByRaw("FIELD(status , 'borrowed', 'late', 'returned') ASC")
            ->latest()
            ->paginate(10);

        return view('admin.loans.index', compact('loans'));
    }

    // Proses Pengembalian Buku
    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);

        // Cek jika sudah dikembalikan sebelumnya agar tidak double count
        if ($loan->status == 'returned') {
            return back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
        }

        // 1. Update data peminjaman
        $loan->update([
            'status' => 'returned',
            'actual_return_date' => Carbon::now(),
        ]);

        // 2. Kembalikan stok buku
        $loan->book->increment('stock');

        return back()->with('success', 'Buku berhasil dikembalikan dan stok telah ditambahkan.');
    }
    public function print()
    {
        // Ambil semua data peminjaman
        $loans = Loan::with(['user', 'book'])->latest()->get();

        // Load view khusus PDF dan kirim datanya
        $pdf = Pdf::loadView('admin.loans.print', compact('loans'));
        
        // Set ukuran kertas dan orientasi (A4, Potrait/Landscape)
        $pdf->setPaper('a4', 'landscape');

        // Stream (tampilkan di browser) atau Download
        return $pdf->stream('laporan-peminjaman.pdf');
    }
}