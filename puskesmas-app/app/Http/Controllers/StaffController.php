<?php
namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Dokter;
use App\Models\Administrasi;
use App\Models\Apoteker;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function create()
    {
        return Inertia::render('FormTambahStaff');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan'  => 'required|in:dokter,perawat,apoteker,administrasi',
            'nama'     => 'required|string',
            'nip'      => 'required|string',
            'no_hp'    => 'nullable|string',
            'alamat'   => 'nullable|string',
            'username' => 'required|string|unique:akun,username',
            'password' => 'required|string|min:6',
        ]);

        DB::transaction(function () use ($request) {
            $idAkun = 'AKN-' . str_pad(Akun::count() + 1, 3, '0', STR_PAD_LEFT);

            Akun::create([
                'id_akun'       => $idAkun,
                'username'      => $request->username,
                'password_hash' => Hash::make($request->password),
                'role'          => $request->jabatan,
            ]);

            match ($request->jabatan) {
                'dokter' => Dokter::create([
                    'id_dokter'    => 'DKT-' . str_pad(Dokter::count() + 1, 3, '0', STR_PAD_LEFT),
                    'id_akun'      => $idAkun,
                    'nip'          => $request->nip,
                    'nama'         => $request->nama,
                    'spesialisasi' => $request->spesialisasi,
                    'no_str'       => $request->no_str,
                    'no_hp'        => $request->no_hp,
                    'alamat'       => $request->alamat,
                ]),
                'perawat' => Perawat::create([
                    'id_perawat' => 'PRW-' . str_pad(Perawat::count() + 1, 3, '0', STR_PAD_LEFT),
                    'id_akun'    => $idAkun,
                    'nip'        => $request->nip,
                    'nama'       => $request->nama,
                    'no_sip'     => $request->no_sip,
                    'no_hp'      => $request->no_hp,
                    'alamat'     => $request->alamat,
                ]),
                'apoteker' => Apoteker::create([
                    'id_apoteker' => 'APT-' . str_pad(Apoteker::count() + 1, 3, '0', STR_PAD_LEFT),
                    'id_akun'     => $idAkun,
                    'nip'         => $request->nip,
                    'nama'        => $request->nama,
                    'no_stra'     => $request->no_stra,
                    'no_hp'       => $request->no_hp,
                    'alamat'      => $request->alamat,
                ]),
                'administrasi' => Administrasi::create([
                    'id_administrasi' => 'ADM-' . str_pad(Administrasi::count() + 1, 3, '0', STR_PAD_LEFT),
                    'id_akun'         => $idAkun,
                    'nip'             => $request->nip,
                    'nama'            => $request->nama,
                    'no_hp'           => $request->no_hp,
                    'alamat'          => $request->alamat,
                ]),
            };
        });

        return redirect()->route('staff.index')->with('success', 'Staff berhasil ditambahkan.');
    }
}
