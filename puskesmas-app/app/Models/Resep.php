<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Resep = resep obat yang ditulis dokter, dikonfirmasi apoteker
class Resep extends Model
{
    protected $table = 'resep';
    protected $primaryKey = 'id_resep';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_resep', 'id_rekam_medis', 'id_dokter', 'id_apoteker',
        'status', 'waktu_dibuat', 'waktu_konfirmasi'
    ];

    public function rekamMedis() {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis', 'id_rekam_medis');
    }
    public function dokter() {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
    public function apoteker() {
        return $this->belongsTo(Apoteker::class, 'id_apoteker', 'id_apoteker');
    }
    // Satu resep punya banyak detail obat
    public function detailResep() {
        return $this->hasMany(DetailResep::class, 'id_resep', 'id_resep');
    }
}