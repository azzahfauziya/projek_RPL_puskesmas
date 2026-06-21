<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Pendaftaran;
use App\Models\Tindakan;
use App\Models\RekamMedis;
use App\Models\RekamMedisTindakan;
use Illuminate\Support\Facades\Auth;
use App\Helpers\IdGenerator;

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
            'tindakan'    => $tindakan,
        ]);
    }

    public function simpanTindakan(Request $request)
    {
        $request->validate([
            'no_registrasi'     => 'required',
            'tindakan'          => 'required|array|min:1',
            'tindakan.*.id_tindakan' => 'required',
            'tindakan.*.jumlah' => 'required|integer|min:1',
        ]);

        $pendaftaran = Pendaftaran::with(['rekamMedis', 'pasien'])
            ->where('no_registrasi', $request->no_registrasi)
            ->firstOrFail();

        // Buat rekam medis kalau belum ada
        $rekamMedis = $pendaftaran->rekamMedis;
        if (!$rekamMedis) {
            $rekamMedis = RekamMedis::create([
                'id_rekam_medis' => IdGenerator::generateIdRekamMedis(),
                'no_registrasi'  => $request->no_registrasi,
                'no_rm'          => $pendaftaran->no_rm,
            ]);
        }

        // Simpan semua tindakan
        foreach ($request->tindakan as $item) {
            $tindakan = Tindakan::find($item['id_tindakan']);
            $total_harga = $tindakan->harga * $item['jumlah'];

            RekamMedisTindakan::create([
                'id'             => IdGenerator::generateIdRekamMedisTindakan(),
                'id_rekam_medis' => $rekamMedis->id_rekam_medis,
                'id_tindakan'    => $item['id_tindakan'],
                'jumlah'         => $item['jumlah'],
                'total_harga'    => $total_harga,
            ]);
        }

        return redirect()->route('form-tindakan', $request->no_registrasi)
            ->with('success', 'Tindakan berhasil disimpan.');
    }
}