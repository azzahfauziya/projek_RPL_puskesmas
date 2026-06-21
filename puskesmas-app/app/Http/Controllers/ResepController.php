<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Resep;
use App\Models\DetailResep;
use App\Models\Pendaftaran;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ResepController extends Controller
{
    public function formResep($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with([
            'pasien',
            'rekamMedis'
        ])
        ->where('no_registrasi', $no_registrasi)
        ->firstOrFail();

        return Inertia::render('FormResep', [
            'pendaftaran' => $pendaftaran,
            'obat' =>  \App\Models\Obat::orderBy('nama_obat')->get()
        ]);
    }

    public function simpan(Request $request)
    {
        $pendaftaran = Pendaftaran::with('rekamMedis')
            ->where('no_registrasi', $request->no_registrasi)
            ->firstOrFail();

        Resep::create([
            'id_resep' => 'RSP-' . now()->format('ymdHis'),
            'id_rekam_medis' => $pendaftaran->rekamMedis->id_rekam_medis,
            'id_dokter' => Auth::user()->id_dokter,
            'nama_obat' => $request->nama_obat,
            'dosis_obat' => $request->dosis_obat,
            'aturan_pakai' => $request->aturan_pakai,
            'status' => 'menunggu',
            'waktu_dibuat' => now(),
        ]);

        return redirect()->route(
            'detail-pasien',
            $request->no_registrasi
        );
    }

    public function tabelResep()
    {
        $resep = DetailResep::with([
            'resep.rekamMedis.pendaftaran.pasien'
        ])->get();

        return Inertia::render('TabelResepPerawat', [
            'resep' => $resep
        ]);
    }

    public function tabelResepApoteker()
{
    $resepApoteker = DetailResep::with([
        'resep.rekamMedis.pendaftaran.pasien'
    ])->get();

    return Inertia::render('TabelResepApoteker', [
        'resepApoteker' => $resepApoteker
    ]);
}

    public function updateStatus(Request $request, $id_resep)
    {
        Resep::where('id_resep', $id_resep)
            ->update([
                'status' => $request->status
            ]);

        return back();
    }


}