<?php
namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Administrasi;
use App\Models\Apoteker;
use App\Models\Perawat;
use Inertia\Inertia;

class StaffController extends Controller
{
    public function index()
    {
        $staff = collect();

        $staff = $staff->merge(
            Dokter::all()->map(fn($d) => [
                'id'            => $d->id_dokter,
                'nama'          => $d->nama,
                'no_hp'         => $d->no_hp,
                'jabatan'       => 'Dokter',
            ])
        );

        $staff = $staff->merge(
            Administrasi::all()->map(fn($a) => [
                'id'            => $a->id_administrasi,
                'nama'          => $a->nama,
                'no_hp'         => $a->no_hp,
                'jabatan'       => 'Administrasi',
            ])
        );

        $staff = $staff->merge(
            Apoteker::all()->map(fn($a) => [
                'id'            => $a->id_apoteker,
                'nama'          => $a->nama,
                'no_hp'         => $a->no_hp,
                'jabatan'       => 'Apoteker',
            ])
        );

        $staff = $staff->merge(
            Perawat::all()->map(fn($p) => [
                'id'            => $p->id_perawat,
                'nama'          => $p->nama,
                'no_hp'         => $p->no_hp,
                'jabatan'       => 'Perawat',
            ])
        );

        return Inertia::render('TabelDataStaff', [
            'staff' => $staff->values(),
        ]);
    }
}