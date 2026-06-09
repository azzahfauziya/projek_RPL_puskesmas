<?php
namespace App\Models;

// Authenticatable dipakai karena Akun adalah user yang bisa login
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Akun extends Authenticatable
{
    use HasApiTokens;

    protected $table = 'akun';
    protected $primaryKey = 'id_akun';
    public $incrementing = false; // karena PK bukan angka otomatis
    protected $keyType = 'string';
    public $timestamps = false;   // tabel tidak punya created_at/updated_at

    protected $authPasswordName = 'password_hash';  // kolom password kamu
    protected $rememberTokenName = '';
     
    protected $fillable = [
        'id_akun', 'username', 'password_hash', 'role', 'last_login'
    ];

    protected $hidden = ['password_hash']; // jangan ikut tampil di response

    // Override karena nama kolom password kita bukan 'password'
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    // Relasi ke profil masing-masing role
    public function dokter() {
        return $this->hasOne(Dokter::class, 'id_akun', 'id_akun');
    }
    public function perawat() {
        return $this->hasOne(Perawat::class, 'id_akun', 'id_akun');
    }
    public function apoteker() {
        return $this->hasOne(Apoteker::class, 'id_akun', 'id_akun');
    }
    public function administrasi() {
        return $this->hasOne(Administrasi::class, 'id_akun', 'id_akun');
    }

    // Helper untuk ambil profil sesuai role yang login
    public function getProfil()
    {
        return match($this->role) {
            'dokter'       => $this->dokter,
            'perawat'      => $this->perawat,
            'apoteker'     => $this->apoteker,
            'administrasi' => $this->administrasi,
            default        => null,
        };
    }
}
