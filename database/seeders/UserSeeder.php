<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Buat Admin
    \App\Models\User::create([
        'name' => 'Admin Perpustakaan',
        'email' => 'admin@perpus.com',
        'password' => bcrypt('password'), // password: password
        'role' => 'admin',
    ]);

    // Buat Peminjam Biasa
    \App\Models\User::create([
        'name' => 'Siswa Teladan',
        'email' => 'siswa@perpus.com',
        'password' => bcrypt('password'),
        'role' => 'user',
        'address' => 'Jl. Mawar No 10',
        'phone' => '08123456789'
    ]);
}
}
