<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Pendaftaran = satu kunjungan pasien ke puskesmas
class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';
    protected $primaryKey = 'no_registrasi';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_registrasi', 'no_rm', 'id_administrasi', 'id_dokter',
        'keluhan_awal', 'tanggal_kunjungan', 'status_antrian'
    ];

    public function pasien() {
        return $this->belongsTo(Pasien::class, 'no_rm', 'no_rm');
    }
    public function dokter() {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id_dokter');
    }
    public function administrasi() {
        return $this->belongsTo(Administrasi::class, 'id_administrasi', 'id_administrasi');
    }
    // Satu kunjungan punya satu rekam medis
    public function rekamMedis() {
        return $this->hasOne(RekamMedis::class, 'no_registrasi', 'no_registrasi');
    }
    // Satu kunjungan punya satu tagihan
    public function billing() {
        return $this->hasOne(Billing::class, 'no_registrasi', 'no_registrasi');
    }
}