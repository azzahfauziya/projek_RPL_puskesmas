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
            'obat' =>  Obat::where('stok', '>', 0)
                ->orderBy('nama_obat')
                ->get()
        ]);
    }
    public function simpan(Request $request)
    {
        $pendaftaran = Pendaftaran::with('rekamMedis')
            ->where('no_registrasi', $request->no_registrasi)
            ->firstOrFail();

        $rekamMedis = $pendaftaran->rekamMedis;

        // Buat atau ambil resep yang sudah ada untuk rekam medis ini
        $resep = Resep::firstOrCreate(
            ['id_rekam_medis' => $rekamMedis->id_rekam_medis],
            [
                'id_resep'    => 'RSP-' . now()->format('ymdHi'),
                'id_dokter'   => $rekamMedis->id_dokter,
                'status'      => 'proses',
                'waktu_dibuat' => now(),
            ]
        );

        $obat = \App\Models\Obat::findOrFail($request->id_obat);

        $jumlahDetail = DetailResep::count() + 1;

        DetailResep::create([
            'id_detail'            => 'DTL-' . str_pad($jumlahDetail, 3, '0', STR_PAD_LEFT),
            'id_resep'             => $resep->id_resep,
            'id_obat'              => $request->id_obat,
            'nama_obat_saat_resep' => $obat->nama_obat,
            'aturan_pakai'         => $request->aturan_pakai,
            'jumlah'               => $request->jumlah ?? 1,
        ]);

        return redirect()->route('detail-pasien', $request->no_registrasi);
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
        $resep = Resep::with('detailResep')
            ->where('id_resep', $id_resep)
            ->firstOrFail();

        if (
            $request->status === 'selesai'
            && $resep->status !== 'selesai'
        ) {
            foreach ($resep->detailResep as $detail) {

                Obat::where('id_obat', $detail->id_obat)
                    ->decrement('stok', $detail->jumlah);
            }
        }
        
        $resep->update([
            'status' => $request->status
        ]);

        return back();
    }
}
