<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Pendaftaran;
use App\Helpers\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BillingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'no_registrasi'     => 'required',
            'metode_pembayaran' => 'required',
            'jumlah_dibayarkan' => 'required|numeric|min:0',
        ]);

        $pendaftaran = Pendaftaran::with([
            'rekamMedis.tindakan.tindakan',
            'rekamMedis.resep.detailResep.obat',
            'pasien',
        ])->where('no_registrasi', $request->no_registrasi)->firstOrFail();

        $rekamMedis = $pendaftaran->rekamMedis;

        // Hitung total
        $totalTindakan = $rekamMedis?->tindakan->sum('total_harga') ?? 0;
        $totalObat = $rekamMedis?->resep?->detailResep->sum(
            fn($d) => ($d->obat?->harga_satuan ?? 0) * $d->jumlah
        ) ?? 0;
        $totalKotor = $totalTindakan + $totalObat;

        // Potongan BPJS — 10% kalau punya kelas BPJS
        $potongan = $pendaftaran->pasien->kelas_bpjs ? round($totalKotor * 0.1) : 0;
        $totalBayar = $totalKotor - $potongan;

        // Tambah ini
        if ($totalBayar <= 0) {
            $statusPembayaran = 'lunas';
        } else {
            $statusPembayaran = $request->jumlah_dibayarkan >= $totalBayar ? 'lunas' : 'belum_lunas';
        }

        // Cek apakah billing sudah ada
        $billing = Billing::where('no_registrasi', $request->no_registrasi)->first();

        if ($billing) {
            $sudahDibayar = $billing->jumlah_dibayarkan + $request->jumlah_dibayarkan;
            $statusPembayaran = $sudahDibayar >= $totalBayar ? 'lunas' : 'belum_lunas';
            $billing->update([
                'metode_pembayaran'  => $request->metode_pembayaran,
                'jumlah_dibayarkan'  => $sudahDibayar,
                'status_pembayaran'  => $statusPembayaran,
                'waktu_bayar'        => Carbon::now(),
            ]);
        } else {
            // Generate id_billing
            $id_billing = IdGenerator::generateIdBilling();

            Billing::create([
                'id_billing'         => $id_billing,
                'no_registrasi'      => $request->no_registrasi,
                'id_administrasi'    => Auth::user()->administrasi->id_administrasi,
                'total_tindakan'     => $totalTindakan,
                'total_obat'         => $totalObat,
                'total_kotor'        => $totalKotor,
                'potongan_bpjs'      => $potongan,
                'total_bayar'        => $totalBayar,
                'metode_pembayaran'  => $request->metode_pembayaran,
                'jumlah_dibayarkan'  => $request->jumlah_dibayarkan,
                'status_pembayaran'  => $statusPembayaran,
                'waktu_bayar'        => Carbon::now(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Pembayaran berhasil diproses.');
    }
}
