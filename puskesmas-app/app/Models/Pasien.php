<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';
    protected $primaryKey = 'no_rm';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'no_rm', 'nama', 'tanggal_lahir', 'jenis_kelamin',
        'alamat', 'no_hp', 'kelas_bpjs'
    ];

    // Satu pasien bisa kunjungan berkali-kali
    public function pendaftaran() {
        return $this->hasMany(Pendaftaran::class, 'no_rm', 'no_rm');
    }
}
