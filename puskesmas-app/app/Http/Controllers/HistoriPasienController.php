<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use Inertia\Inertia;

class HistoriPasienController extends Controller
{
    public function show($no_rm)
    {
        $pasien = Pasien::where('no_rm', $no_rm)->firstOrFail();

        $pendaftaran = Pendaftaran::with([
            'rekamMedis.tindakan.tindakan',
            'rekamMedis.resep.detailResep.obat',
        ])
            ->where('no_rm', $pasien->no_rm)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        $kunjungan = $pendaftaran->map(fn($p) => [
            'no_registrasi'     => $p->no_registrasi,
            'tanggal_kunjungan' => $p->tanggal_kunjungan,
            'keluhan'           => $p->rekamMedis?->keluhan,
            'diagnosa'          => $p->rekamMedis?->diagnosa,
            'tinggi_badan'      => $p->rekamMedis?->tinggi_badan,
            'berat_badan'       => $p->rekamMedis?->berat_badan,
            'tindakan'          => $p->rekamMedis?->tindakan->map(fn($t) => [
                'id_tindakan'   => $t->id_tindakan,
                'nama_tindakan' => $t->tindakan?->nama_tindakan,
                'jumlah'        => $t->jumlah,
            ]) ?? [],
            'obat' => $p->rekamMedis?->resep?->detailResep->map(fn($d) => [
                'id_obat'      => $d->id_obat,
                'nama_obat'    => $d->nama_obat_saat_resep,
                'jumlah'       => $d->jumlah,
                'aturan_pakai' => $d->aturan_pakai,
            ]) ?? [],
        ]);

        return Inertia::render('Histori', [
            'pasien'    => $pasien,
            'kunjungan' => $kunjungan,
        ]);
    }
}