<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Inertia\Inertia;

class TagihanController extends Controller
{
    public function show($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with([
            'pasien',
            'rekamMedis.tindakan.tindakan',
            'rekamMedis.resep.detailResep.obat',
        ])->where('no_registrasi', $no_registrasi)->firstOrFail();

        $rekamMedis = $pendaftaran->rekamMedis;

        // Tindakan
        $tindakan = $rekamMedis?->tindakan->map(fn($t) => [
            'id_tindakan'   => $t->id_tindakan,
            'nama_tindakan' => $t->tindakan?->nama_tindakan,
            'jumlah'        => $t->jumlah,
            'harga'         => $t->tindakan?->harga,
            'total_harga'   => $t->total_harga,
        ]) ?? collect();

        // Obat dari detail resep
        $obat = $rekamMedis?->resep?->detailResep->map(fn($d) => [
            'id_obat'    => $d->id_obat,
            'nama_obat'  => $d->nama_obat_saat_resep,
            'jumlah'     => $d->jumlah,
            'harga'      => $d->obat?->harga_satuan,
            'total_harga'=> ($d->obat?->harga_satuan ?? 0) * $d->jumlah,
        ]) ?? collect();

        return Inertia::render('Tagihan', [
            'pendaftaran' => $pendaftaran,
            'tindakan'    => $tindakan,
            'obat'        => $obat,
        ]);
    }
}