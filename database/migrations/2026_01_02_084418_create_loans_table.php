<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
        $table->foreignId('book_id')->constrained()->onDelete('cascade'); // Relasi ke buku
        
        $table->date('loan_date'); // Tanggal pinjam
        $table->date('return_date'); // Tanggal wajib kembali
        $table->date('actual_return_date')->nullable(); // Tanggal dikembalikan (diisi saat admin memproses pengembalian)
        
        // Status peminjaman
        $table->enum('status', ['borrowed', 'returned', 'late'])->default('borrowed');
        
        $table->text('notes')->nullable(); // Catatan kondisi buku dsb
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('loans');
}
};
