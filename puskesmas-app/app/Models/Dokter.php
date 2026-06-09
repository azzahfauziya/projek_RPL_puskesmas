<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_dokter', 'id_akun', 'nip', 'nama',
        'spesialisasi', 'no_str', 'no_hp', 'alamat'
    ];

    public function akun() {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
    // Dokter bisa menangani banyak pendaftaran
    public function pendaftaran() {
        return $this->hasMany(Pendaftaran::class, 'id_dokter', 'id_dokter');
    }
    // Dokter bisa punya banyak rekam medis
    public function rekamMedis() {
        return $this->hasMany(RekamMedis::class, 'id_dokter', 'id_dokter');
    }
    // Dokter bisa tulis banyak resep
    public function resep() {
        return $this->hasMany(Resep::class, 'id_dokter', 'id_dokter');
    }
}
