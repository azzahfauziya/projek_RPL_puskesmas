<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Pendaftaran;
use App\Models\Tindakan;
use App\Models\RekamMedisTindakan;

class TindakanController extends Controller
{
    public function formTindakan($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with([
            'pasien',
            'rekamMedis'
        ])->where('no_registrasi', $no_registrasi)
        ->firstOrFail();

        $tindakan = Tindakan::orderBy('nama_tindakan')->get();

        return Inertia::render('FormTindakan', [
            'pendaftaran' => $pendaftaran,
            'tindakan' => $tindakan,
        ]);
    }

    public function simpanTindakan(Request $request)
    {
        $request->validate([
            'id_tindakan' => 'required',
            'jumlah' => 'required|integer|min:1',
            'no_registrasi' => 'required'
        ]);

        $pendaftaran = Pendaftaran::with('rekamMedis')
            ->where('no_registrasi', $request->no_registrasi)
            ->firstOrFail();

        RekamMedisTindakan::create([
            'id_rekam_medis' => $pendaftaran->rekamMedis->id_rekam_medis,
            'id_tindakan' => $request->id_tindakan,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route(
            'detail-pasien',
            $request->no_registrasi
        );
    }
}
    
?>