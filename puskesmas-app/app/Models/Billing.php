<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Billing = tagihan per kunjungan (tindakan + obat - diskon BPJS)
class Billing extends Model
{
    protected $table = 'billing';
    protected $primaryKey = 'id_billing';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_billing',
        'no_registrasi',
        'id_administrasi',
        'total_tindakan',
        'total_obat',
        'total_kotor',
        'potongan_bpjs',
        'total_bayar',
        'metode_pembayaran',
        'jumlah_dibayarkan',
        'status_pembayaran',
        'waktu_bayar'
    ];

    protected $casts = [
        'waktu_bayar' => 'datetime',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'no_registrasi', 'no_registrasi');
    }
    public function administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'id_administrasi', 'id_administrasi');
    }
}
