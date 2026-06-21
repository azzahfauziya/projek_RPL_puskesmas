<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PasienController extends Controller
{
    // public function dataPasien()
    // {
    //     $pasien = Pasien::orderBy('nama')->get();

    //     return Inertia::render('TabelDataPasien', [
    //         'pasien' => $pasien,
    //     ]);
    // }

    public function detailPasien($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with([
            'pasien',
            'dokter',
            'rekamMedis',
            'billing'
        ])
        ->where('no_registrasi', $no_registrasi)
        ->firstOrFail();

        return Inertia::render('DetailPasien', [
            'pendaftaran' => $pendaftaran
        ]);
    }

    public function dataPasien()
    {
        $pasien = Pasien::orderBy('no_rm')->get();

        return Inertia::render('DataPasien', [
            'pasien' => $pasien,
        ]);
    }

    public function detail($no_rm)
    {
        $pasien = Pasien::where('no_rm', $no_rm)->firstOrFail();
        return response()->json($pasien);
    }
}