<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Tabel pivot — mencatat tindakan apa saja yang dilakukan per rekam medis
class RekamMedisTindakan extends Model
{
    protected $table = 'rekam_medis_tindakan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id', 'id_rekam_medis', 'id_tindakan', 'jumlah', 'total_harga'
    ];

    public function rekamMedis() {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis', 'id_rekam_medis');
    }
    public function tindakan() {
        return $this->belongsTo(Tindakan::class, 'id_tindakan', 'id_tindakan');
    }
}