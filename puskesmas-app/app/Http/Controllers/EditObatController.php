<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Inertia\Inertia;
use App\Models\Obat;

class EditObatController extends Controller
{
    public function editObat()
    {
        $obat = Obat::orderBy('nama_obat')->get();

        return Inertia::render('EditTabelObat', [
            'obat' => $obat
        ]);
    }

    public function updateSemua(Request $request)
    {
        foreach ($request->obat as $item) {
            Obat::where('id_obat', $item['id_obat'])->update([
                'nama_obat' => $item['nama_obat'],
                'stok' => $item['stok'],
                'harga_satuan' => $item['harga_satuan'],
                'bentuk' => $item['bentuk'],
                'satuan' => $item['satuan'],
            ]);
        }

        return to_route('obat.apoteker');
    }
}