<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;
use App\Models\Obat;
use App\Helpers\IdGenerator;

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

            if (empty($item['id_obat'])) {

                Obat::create([
                    'id_obat' => IdGenerator::generateIdObat(),
                    'id_apoteker' => Auth::user()->apoteker->id_apoteker,
                    'nama_obat' => $item['nama_obat'],
                    'stok' => $item['stok'],
                    'harga_satuan' => $item['harga_satuan'],
                    'bentuk' => $item['bentuk'],
                    'satuan' => $item['satuan'],
                ]);

            } else {

                Obat::where('id_obat', $item['id_obat'])->update([
                    'nama_obat' => $item['nama_obat'],
                    'stok' => $item['stok'],
                    'harga_satuan' => $item['harga_satuan'],
                    'bentuk' => $item['bentuk'],
                    'satuan' => $item['satuan'],
                ]);
            }
        }

        return redirect()->route('obat.apoteker');
    }
}