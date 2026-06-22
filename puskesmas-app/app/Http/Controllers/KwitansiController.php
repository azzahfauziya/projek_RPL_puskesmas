<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Pendaftaran;
use Inertia\Inertia;

class KwitansiController extends Controller
{
    public function show(Request $request, $no_registrasi)
    {
        $pendaftaran = Pendaftaran::with([
            'pasien',
            'rekamMedis.tindakan.tindakan',
            'rekamMedis.resep.detailResep.obat',
            'billing',
        ])->where('no_registrasi', $no_registrasi)->firstOrFail();

        $rekamMedis = $pendaftaran->rekamMedis;

        $tindakan = $rekamMedis?->tindakan->map(fn($t) => [
            'id_tindakan'   => $t->id_tindakan,
            'nama_tindakan' => $t->tindakan?->nama_tindakan,
            'jumlah'        => $t->jumlah,
            'harga'         => $t->tindakan?->harga,
            'total_harga'   => $t->total_harga,
        ]) ?? collect();

        $obat = $rekamMedis?->resep?->detailResep->map(fn($d) => [
            'id_obat'     => $d->id_obat,
            'nama_obat'   => $d->nama_obat_saat_resep,
            'jumlah'      => $d->jumlah,
            'harga'       => $d->obat?->harga_satuan,
            'total_harga' => ($d->obat?->harga_satuan ?? 0) * $d->jumlah,
        ]) ?? collect();

        $billing = $pendaftaran->billing;

        // Ambil dari billing kalau sudah ada, fallback hitung ulang
        $totalTindakan = $billing?->total_tindakan ?? $tindakan->sum('total_harga');
        $totalObat     = $billing?->total_obat     ?? $obat->sum('total_harga');
        $totalKotor    = $billing?->total_kotor    ?? ($totalTindakan + $totalObat);
        $potongan      = $billing?->potongan_bpjs  ?? 0;
        $totalBayar    = $billing?->total_bayar    ?? ($totalKotor - $potongan);
        $sudahDibayar  = $billing?->jumlah_dibayarkan ?? 0;
        $kembalian = max(
            0,
            $sudahDibayar - $totalBayar
        );
        $sisaTagihan   = max(0, $totalBayar - $sudahDibayar);

        return Inertia::render('Kwitansi', [
            'pendaftaran'   => $pendaftaran,
            'tindakan'      => $tindakan,
            'obat'          => $obat,
            'totalTindakan' => $totalTindakan,
            'totalObat'     => $totalObat,
            'totalKotor'    => $totalKotor,
            'potongan'      => $potongan,
            'totalBayar'    => $totalBayar,
            'sudahDibayar'  => $sudahDibayar,
            'kembalian'     => $kembalian,
            'sisaTagihan'   => $sisaTagihan,
            'statusPembayaran' => $billing?->status_pembayaran ?? 'belum_lunas',
            'metodePembayaran' => $billing?->metode_pembayaran ?? '-',
            'waktuBayar'    => $billing?->waktu_bayar?->format('d/m/Y H:i') ?? '-',
            'from'          => $request->from
        ]);
    }
}