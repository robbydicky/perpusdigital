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
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relasi ke categories
        $table->string('title');
        $table->string('author');
        $table->string('publisher');
        $table->year('publication_year');
        $table->integer('stock'); // Jumlah buku yang tersedia
        $table->string('cover_image')->nullable(); // Path gambar cover
        $table->text('synopsis')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('books');
}
};
