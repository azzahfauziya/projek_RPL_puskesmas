<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    protected $table = 'apoteker';
    protected $primaryKey = 'id_apoteker';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_apoteker', 'id_akun', 'nip', 'nama', 'no_stra', 'no_hp', 'alamat'
    ];

    public function akun() {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
    // Apoteker kelola banyak obat
    public function obat() {
        return $this->hasMany(Obat::class, 'id_apoteker', 'id_apoteker');
    }
    // Apoteker konfirmasi banyak resep
    public function resep() {
        return $this->hasMany(Resep::class, 'id_apoteker', 'id_apoteker');
    }
}