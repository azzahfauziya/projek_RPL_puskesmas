<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

// Tindakan = master data jenis tindakan medis beserta harganya
class Tindakan extends Model
{
    protected $table = 'tindakan';
    protected $primaryKey = 'id_tindakan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id_tindakan', 'nama_tindakan', 'harga'];
}