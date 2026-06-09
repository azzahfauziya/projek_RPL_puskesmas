<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// ✅ Sesuaikan dengan tabel yang sudah ada
public function up(): void
{
    // Tabel sudah dibuat manual, skip jika sudah ada
    if (Schema::hasTable('akun')) {
        return;
    }

    Schema::create('akun', function (Blueprint $table) {
        $table->string('id_akun')->primary();
        $table->string('username')->unique();
        $table->string('password_hash');
        $table->string('role');
        $table->timestamp('last_login')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akun');
    }
};
