<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'loan_date',
        'return_date',
        'actual_return_date',
        'status',
        'notes'
    ];

    // Relasi: Peminjaman milik satu User (Belongs To)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman terkait satu Buku (Belongs To)
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}