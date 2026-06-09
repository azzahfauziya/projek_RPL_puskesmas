<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Detail resep = rincian tiap obat dalam satu resep (dosis, aturan pakai, jumlah)
class DetailResep extends Model
{
    protected $table = 'detail_resep';
    protected $primaryKey = 'id_detail';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_detail', 'id_resep', 'id_obat', 'nama_obat_saat_resep',
        'dosis', 'satuan_dosis', 'aturan_pakai', 'jumlah'
    ];

    public function resep() {
        return $this->belongsTo(Resep::class, 'id_resep', 'id_resep');
    }
    public function obat() {
        return $this->belongsTo(Obat::class, 'id_obat', 'id_obat');
    }
}