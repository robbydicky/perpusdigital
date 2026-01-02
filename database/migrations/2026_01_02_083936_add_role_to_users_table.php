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
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom role setelah email, defaultnya 'user'
        $table->enum('role', ['admin', 'user'])->default('user')->after('email');
        
        // Opsional: Kolom alamat & telepon untuk data anggota
        $table->text('address')->nullable()->after('role');
        $table->string('phone')->nullable()->after('address');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['role', 'address', 'phone']);
    });
}
};
