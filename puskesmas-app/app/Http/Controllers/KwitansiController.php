<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Inertia\Inertia;

class KwitansiController extends Controller
{
    public function show($no_registrasi)
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

        $totalTindakan = $tindakan->sum('total_harga');
        $totalObat     = $obat->sum('total_harga');
        $totalKotor    = $totalTindakan + $totalObat;
        $potongan      = $pendaftaran->billing?->potongan_bpjs ?? 0;
        $totalBayar    = $pendaftaran->billing?->total_bayar ?? ($totalKotor - $potongan);

        return Inertia::render('Kwitansi', [
            'pendaftaran'   => $pendaftaran,
            'tindakan'      => $tindakan,
            'obat'          => $obat,
            'totalTindakan' => $totalTindakan,
            'totalObat'     => $totalObat,
            'totalKotor'    => $totalKotor,
            'potongan'      => $potongan,
            'totalBayar'    => $totalBayar,
            'sudahDibayar'  => $pendaftaran->billing?->jumlah_dibayarkan ?? 0,
        ]);
    }
}