<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Obat = master data stok obat yang dikelola apoteker
class Obat extends Model
{
    protected $table = 'obat';
    protected $primaryKey = 'id_obat';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_obat', 'id_apoteker', 'nama_obat', 'stok',
        'harga_satuan', 'bentuk', 'satuan'
    ];

    public function apoteker() {
        return $this->belongsTo(Apoteker::class, 'id_apoteker', 'id_apoteker');
    }
    public function detailResep() {
        return $this->hasMany(DetailResep::class, 'id_obat', 'id_obat');
    }
}