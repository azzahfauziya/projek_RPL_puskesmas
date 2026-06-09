<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_perawat', 'id_akun', 'nip', 'nama', 'no_sip', 'no_hp', 'alamat'
    ];

    public function akun() {
        return $this->belongsTo(Akun::class, 'id_akun', 'id_akun');
    }
    public function rekamMedis() {
        return $this->hasMany(RekamMedis::class, 'id_perawat', 'id_perawat');
    }
}