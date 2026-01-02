<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\AdminLoanController;

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard'); // Halaman dashboard untuk User/Peminjam
})->middleware(['auth', 'verified'])->name('dashboard');


// --- AREA ADMIN ---
// Semua route di dalam grup ini hanya bisa diakses oleh role 'admin'
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        // Ambil data statistik
        $totalBooks = Book::sum('stock'); // Total stok fisik buku
        $totalTitles = Book::count();     // Total judul buku
        $activeLoans = Loan::where('status', 'borrowed')->count(); // Buku yang sedang dipinjam
        $totalUsers = User::where('role', 'user')->count(); // Jumlah anggota
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('totalBooks', 'totalTitles', 'activeLoans', 'totalUsers', 'totalCategories'));
    })->name('dashboard');
    // Nanti kita tambahkan route CRUD Buku di sini
    Route::resource('books', BookController::class);
    Route::get('/loans', [AdminLoanController::class, 'index'])->name('loans.index');
    
    // Tambahkan ini: Route Cetak PDF
    Route::get('/loans/print', [AdminLoanController::class, 'print'])->name('loans.print');
    
    Route::post('/loans/{id}/return', [AdminLoanController::class, 'returnBook'])->name('loans.return');
    // Route::resource('loans', LoanController::class);
    Route::resource('categories', CategoryController::class);
});


// --- AREA USER / PEMINJAM ---http://127.0.0.1:8000/admin/books
// Route khusus user biasa
Route::middleware(['auth', 'role:user'])->group(function () {
    // Misalnya route untuk lihat katalog buku & pinjam
    // Route::get('/katalog', [BookController::class, 'index'])->name('katalog');
});

// --- AREA USER / PEMINJAM ---
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    
    // Dashboard User (Katalog Buku)
    Route::get('/dashboard', function () {
        // Ambil buku yang stoknya > 0 saja
        $books = \App\Models\Book::with('category')->where('stock', '>', 0)->latest()->get();
        return view('dashboard', compact('books'));
    })->name('dashboard');

    // Route untuk memproses peminjaman
    Route::post('/loans', [App\Http\Controllers\LoanController::class, 'store'])->name('loans.store');

    // Route untuk melihat daftar pinjaman saya
    Route::get('/my-loans', [App\Http\Controllers\LoanController::class, 'index'])->name('my-loans');
});


// Route Bawaan Breeze (Profile dsb)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
