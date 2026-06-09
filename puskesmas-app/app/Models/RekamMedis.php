<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Rekam medis = hasil pemeriksaan dokter per kunjungan
class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'id_rekam_medis';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_rekam_medis', 'no_registrasi', 'id_dokter', 'id_perawat',
        'diagnosa', 'tinggi_badan', 'berat_badan', 'waktu_input'
    ];

    public function pendaftaran() {
        return $this->belongsTo(Pendaftaran::class, 'no_registrasi', 'no_registrasi');
    }
    public function dokter() {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
    public function perawat() {
        return $this->belongsTo(Perawat::class, 'id_perawat', 'id_perawat');
    }
    // Rekam medis bisa punya banyak tindakan
    public function tindakan() {
        return $this->hasMany(RekamMedisTindakan::class, 'id_rekam_medis', 'id_rekam_medis');
    }
    // Rekam medis punya satu resep
    public function resep() {
        return $this->hasOne(Resep::class, 'id_rekam_medis', 'id_rekam_medis');
    }
}