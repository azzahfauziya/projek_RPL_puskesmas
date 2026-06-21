<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AntrianController extends Controller
{
public function daftarAntrian()
{
    $antrian = Pendaftaran::with('pasien')
        //->whereDate('tanggal_kunjungan', today())
        // ->orderBy('tanggal_kunjungan', 'asc')
        // ->whereDate('tanggal_kunjungan', today())
        ->orderByRaw("CASE WHEN status_antrian = 'selesai' THEN 1 ELSE 0 END ASC")
        ->orderBy('no_registrasi', 'asc')
        ->get();

    return Inertia::render('TabelAntrian', [
        'antrian' => $antrian,
    ]);
}

public function daftarKunjungan()
{
    $kunjungan = Pendaftaran::with('pasien')
        ->orderBy('tanggal_kunjungan', 'desc')
        ->get();

    // return inertia('Antrian/Index', ['antrian' => $antrian]);
        return Inertia::render('TabelKunjungan', [
        'kunjungan' => $kunjungan,
    ]);
}
}