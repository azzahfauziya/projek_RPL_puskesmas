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
            ->whereDate('tanggal_kunjungan', today())
            ->where('status_antrian', '!=', 'selesai')
            // ->orderByRaw("CASE WHEN status_antrian = 'selesai' THEN 1 ELSE 0 END ASC")
            ->orderBy('no_registrasi', 'asc')
            ->get();

        return Inertia::render('TabelAntrian', [
            'antrian' => $antrian,
        ]);
    }

    public function daftarKunjungan()
    {
        $kunjungan = Pendaftaran::with(['pasien', 'billing'])
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get()
            ->map(fn($p) => [
                'no_rm'             => $p->pasien->no_rm,
                'no_registrasi'     => $p->no_registrasi,
                'pasien'            => $p->pasien,
                'tanggal_kunjungan' => $p->tanggal_kunjungan,
                'status_pembayaran' => $p->billing?->status_pembayaran ?? 'belum_lunas',
            ]);

        return Inertia::render('TabelKunjungan', [
            'kunjungan' => $kunjungan,
        ]);
    }
}
