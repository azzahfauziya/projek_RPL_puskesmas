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
        ->whereDate('tanggal_kunjungan', today())
        ->orderBy('tanggal_kunjungan', 'asc')
        ->get();

    // return inertia('Antrian/Index', ['antrian' => $antrian]);
        return Inertia::render('TabelAntrian', [
        'antrian' => $antrian,
    ]);
}
}