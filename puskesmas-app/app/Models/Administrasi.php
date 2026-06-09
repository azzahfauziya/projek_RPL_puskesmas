<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    protected $table = 'administrasi';
    protected $primaryKey = 'id_administrasi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_administrasi', 'id_akun', 'nip', 'nama', 'no_hp', 'alamat'
    ];

    // Satu administrasi punya satu akun login
    public function akun() {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
    // Satu administrasi bisa daftarkan banyak pasien
    public function pendaftaran() {
        return $this->hasMany(Pendaftaran::class, 'id_administrasi', 'id_administrasi');
    }
    // Satu administrasi bisa proses banyak billing
    public function billing() {
        return $this->hasMany(Billing::class, 'id_administrasi', 'id_administrasi');
    }
}