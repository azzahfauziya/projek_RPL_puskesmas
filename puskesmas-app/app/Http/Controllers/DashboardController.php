<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Billing;
use App\Models\Resep;
use App\Models\Obat;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    // Dashboard administrasi — tampilkan antrian hari ini + statistik
    public function administrasi()
    {
        $antrian = Pendaftaran::with(['pasien', 'dokter'])
            ->whereDate('tanggal_kunjungan', today())
            ->orderBy('no_registrasi')
            ->get();

        return Inertia::render('Dashboard/Administrasi', [
            'totalPasien'        => Pasien::count(),
            'pendaftaranHariIni' => $antrian->count(),
            'billingBelumLunas'  => Billing::where('status_pembayaran', 'belum_lunas')->count(),
            'antrian'            => $antrian,
        ]);
    }

    // Dashboard dokter — tampilkan antrian pasien milik dokter yang login
    public function dokter()
    {
        $dokter = Auth::user()->dokter;

        $antrian = Pendaftaran::with(['pasien'])
            ->where('id_dokter', $dokter->id_dokter)
            ->whereDate('tanggal_kunjungan', today())
            ->orderBy('no_registrasi')
            ->get();

        return Inertia::render('Dashboard/Administrasi', [
            'totalAntrian'       => $antrian->count(),
            'sudahDiperiksa'     => $antrian->where('status_antrian', 'diperiksa')->count(),
            'antrian'            => $antrian,
            'pendaftaranHariIni' => Pendaftaran::whereDate('tanggal_kunjungan', today())->count(),
        ]);
    }

    public function perawat()
    {
        $perawat = Auth::user()->perawat;

        $antrian = Pendaftaran::with(['pasien'])
            ->where('id_dokter', $perawat->id_perawat)
            ->whereDate('tanggal_kunjungan', today())
            ->orderBy('no_registrasi')
            ->get();

        return Inertia::render('Dashboard/Administrasi', [
            'totalAntrian'       => $antrian->count(),
            'sudahDiperiksa'     => $antrian->where('status_antrian', 'diperiksa')->count(),
            'antrian'            => $antrian,
            'pendaftaranHariIni' => Pendaftaran::whereDate('tanggal_kunjungan', today())->count(),
        ]);
    }

    public function apoteker()
    {
        $resepTerbaru = Resep::with(['dokter', 'rekamMedis.pendaftaran.pasien'])
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest('waktu_dibuat')
            ->take(10)
            ->get();

        return Inertia::render('Dashboard/Administrasi', [
            'totalObat'          => Obat::count(),
            'resepMenunggu'      => Resep::where('status', 'menunggu')->count(),
            'obatMenipis'        => Obat::where('stok', '<', 10)->count(),
            'resepTerbaru'       => $resepTerbaru,
            'pendaftaranHariIni' => Pendaftaran::whereDate('tanggal_kunjungan', today())->count(),
        ]);
    }
}
