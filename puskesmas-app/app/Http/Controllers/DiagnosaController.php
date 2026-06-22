<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\RekamMedis;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function create($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with('pasien')
            ->findOrFail($no_registrasi);

        return inertia('FormDiagnosa', [
            'pendaftaran' => $pendaftaran,
            'dokters' => \App\Models\Dokter::all(),
        ]);
    }

    public function store(Request $request)
    {
        $cek = RekamMedis::where(
            'no_registrasi',
            $request->no_registrasi
        )->exists();

        if ($cek) {
            return back()->withErrors([
                'diagnosa' => 'Diagnosa untuk pasien ini sudah pernah dibuat.'
            ]);
        }
        
        $request->validate([
            'no_registrasi' => 'required',
            'id_dokter' => 'required', 
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tensi' => 'required',
            'suhu' => 'required|numeric',
            'diagnosa' => 'required'
        ]);

        $jumlah = RekamMedis::count() + 1;

        $id = 'RM-' . date('dmy') . '-' .
            str_pad($jumlah, 3, '0', STR_PAD_LEFT);

        RekamMedis::create([
            'id_rekam_medis' => $id,
            'no_registrasi' => $request->no_registrasi,
            'id_dokter' => $request->id_dokter,
            'diagnosa' => $request->diagnosa,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'tensi' => $request->tensi,
            'suhu' => $request->suhu,
        ]);

        Pendaftaran::where(
            'no_registrasi',
            $request->no_registrasi
        )->update([
            'status_antrian' => 'selesai'
        ]);

        return redirect()->route('detail-pasien', $request->no_registrasi);
    }
}