<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        // Akun login
        DB::table('akun')->insert([
            ['id_akun' => 'AKN-001', 'username' => 'admin01',    'password_hash' => Hash::make('admin123'),    'role' => 'administrasi'],
            ['id_akun' => 'AKN-002', 'username' => 'dokter01',   'password_hash' => Hash::make('dokter123'),   'role' => 'dokter'],
            ['id_akun' => 'AKN-003', 'username' => 'apoteker01', 'password_hash' => Hash::make('apoteker123'), 'role' => 'apoteker'],
        ]);

        // Profil administrasi
        DB::table('administrasi')->insert([
            'id_administrasi' => 'ADM-001',
            'id_akun'         => 'AKN-001',
            'nip'             => '198001012010011001',
            'nama'            => 'Siti Rahayu',
            'no_hp'           => '081234567890',
            'alamat'          => 'Jl. Sehat No. 1',
        ]);

        // Profil dokter
        DB::table('dokter')->insert([
            'id_dokter'    => 'DKT-001',
            'id_akun'      => 'AKN-002',
            'nip'          => '198501012010011002',
            'nama'         => 'dr. Azzah Fauziya',
            'spesialisasi' => 'Dokter Umum',
            'no_str'       => 'STR-2025-001',
            'no_hp'        => '081234567891',
            'alamat'       => 'Jl. Sehat No. 2',
        ]);

        // Profil dokter
        DB::table('perawat')->insert([
            'perawat'    => 'DKT-001',
            'id_akun'      => 'AKN-002',
            'nip'          => '198501012010011002',
            'nama'         => 'Ns. Azzah Fauziya',
            'spesialisasi' => 'Dokter Umum',
            'no_str'       => 'STR-2025-001',
            'no_hp'        => '081234567891',
            'alamat'       => 'Jl. Sehat No. 2',
        ]);

        // Profil apoteker
        DB::table('apoteker')->insert([
            'id_apoteker' => 'APT-001',
            'id_akun'     => 'AKN-003',
            'nip'         => '199201012016011001',
            'nama'        => 'Apt. Budi Santoso',
            'no_stra'     => 'STRA-2025-001',
            'no_hp'       => '081234567893',
            'alamat'      => 'Jl. Sehat No. 4',
        ]);
    }
}