<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'stock',
        'cover_image',
        'synopsis'
    ];

    // Relasi: Buku milik satu Kategori (Belongs To)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Satu Buku bisa ada di banyak Peminjaman (One to Many)
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}