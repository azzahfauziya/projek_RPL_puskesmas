<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use App\Helpers\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PendaftaranController extends Controller
{

    public function form($no_rm = null)
    {
        $pasien = $no_rm ? Pasien::where('no_rm', $no_rm)->first() : null;

        return Inertia::render('FormDaftar', [
            'pasienAwal' => $pasien,
        ]);
    }


    public function cariPasien(Request $request)
    {
        $pasien = Pasien::where('no_rm', 'like', '%' . $request->q . '%')
            ->orWhere('nama', 'like', '%' . $request->q . '%')
            ->select('no_rm', 'nama')
            ->limit(5)
            ->get();
        return response()->json($pasien);
    }

    public function store(Request $request)
    {
        $isNewPasien = !$request->is_existing;

        $request->validate([
            'keluhan_awal'      => 'required',
            'tanggal_kunjungan' => 'required|date',
            'alamat'            => 'required',
            'nama'              => $isNewPasien ? 'required' : 'nullable',
            'tanggal_lahir'     => $isNewPasien ? 'required|date' : 'nullable',
            'jenis_kelamin'     => $isNewPasien ? 'required' : 'nullable',
            'no_hp'             => $isNewPasien ? 'required' : 'nullable',
            'kelas_bpjs'        => $isNewPasien ? 'required' : 'nullable',
        ]);

        if ($isNewPasien) {
            $no_rm = IdGenerator::generateNoRm();
            Pasien::create([
                'no_rm'         => $no_rm,
                'nama'          => $request->nama,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat'        => $request->alamat,
                'no_hp'         => $request->no_hp,
                'kelas_bpjs'    => $request->kelas_bpjs,
            ]);
        } else {
            $no_rm = $request->no_rm;
            Pasien::where('no_rm', $no_rm)->update(['alamat' => $request->alamat]);
        }

        Pendaftaran::create([
            'no_registrasi'     => IdGenerator::generateNoRegistrasi(),
            'no_rm'             => $no_rm,
            'id_administrasi'   => Auth::user()->administrasi->id_administrasi,
            'keluhan_awal'      => $request->keluhan_awal,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'status_antrian'    => 'menunggu',
        ]);

        return redirect()->route('pendaftaran.form')->with('success', 'Pendaftaran berhasil.');
    }

    private function generateNoRM()
    {
        $last = Pasien::orderBy('no_rm', 'desc')->first();

        if (!$last) {
            return 'RMD0001';
        }

        $number = (int) substr($last->no_rm, 3);
        $number++;

        return 'RMD' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
    
    public function storeDarurat(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => 'required',
            'keluhan_awal' => 'required',
            'tensi' => 'required',
            'suhu' => 'required'
        ]);

        $pasien = Pasien::create([
            'no_rm' => $this->generateNoRM(),
            'nama' => 'Pasien Darurat',
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        $pendaftaran = Pendaftaran::create([
            'no_registrasi' => IdGenerator::generateNoRegistrasi(),
            'no_rm' => $pasien->no_rm,
            'id_administrasi'   => Auth::user()->administrasi->id_administrasi,
            'keluhan_awal' => $request->keluhan_awal,
            'jenis_pendaftaran' => 'darurat',
            'tanggal_kunjungan' => now()->toDateString(),
            'status_antrian' => 'menunggu',
        ]);

        return back();
    }

    public function editDarurat($no_registrasi)
    {
        $pendaftaran = Pendaftaran::with('pasien')
            ->where('no_registrasi', $no_registrasi)
            ->firstOrFail();

        return Inertia::render('FormDaftar', [
            'pendaftaranAwal' => $pendaftaran
        ]);
    }

    public function updateDarurat(Request $request)
    {
        $pendaftaran = Pendaftaran::where(
            'no_registrasi',
            $request->no_registrasi
        )->firstOrFail();

        $pasien = Pasien::where(
            'no_rm',
            $pendaftaran->no_rm
        )->firstOrFail();

        $pasien->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'kelas_bpjs' => $request->kelas_bpjs,
        ]);

        $pendaftaran->update([
            'keluhan_awal' => $request->keluhan_awal,
        ]);

        return redirect()
            ->route('detail-pasien', $request->no_registrasi)
            ->with('success', 'Data pasien berhasil dilengkapi');
    }
}
