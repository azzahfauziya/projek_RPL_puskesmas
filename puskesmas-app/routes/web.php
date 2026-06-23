<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\KwitansiController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\EditObatController;
use App\Http\Controllers\HistoriPasienController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ProfilController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');

    Route::get('/staff', [StaffController::class, 'index'])->name('staff');

    // Administrasi + Dokter
    Route::middleware(['role:administrasi,dokter,perawat'])->group(function () {
        Route::get('/antrian', [AntrianController::class, 'daftarAntrian'])->name('antrian');
        Route::get('/data-pasien', [PasienController::class, 'dataPasien'])->name('data-pasien');
        Route::get('/detail-pasien/{no_registrasi}', [PasienController::class, 'detailPasien'])->name('detail-pasien');
        Route::get('/histori-pasien/{no_rm}', [HistoriPasienController::class, 'show'])->name('histori-pasien');
        Route::post('/pasien-darurat', [PendaftaranController::class, 'storeDarurat'])->name('pasien-darurat.store');
        Route::get('/kwitansi/{no_registrasi}', [KwitansiController::class, 'show'])->name('kwitansi');
        Route::get('/kwitansi/{no_registrasi}', [KwitansiController::class, 'show'])->name('kwitansi');
    });

    // Administrasi
    Route::middleware(['role:administrasi'])->group(function () {
        Route::get('/dashboard/administrasi', [DashboardController::class, 'administrasi'])->name('dashboard.administrasi');
        // Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/tambah', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff/tambah', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/kunjungan', [AntrianController::class, 'daftarKunjungan'])->name('kunjungan');
        //Route::get('/pendaftaran', [PendaftaranController::class, 'form'])->name('pendaftaran.form');
        Route::get('/pendaftaran/cari', [PendaftaranController::class, 'cariPasien'])->name('pendaftaran.cari');
        Route::get('/pendaftaran/{no_rm?}', [PendaftaranController::class, 'form'])->name('pendaftaran.form');
        Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
        Route::get('/pasien/{no_rm}/detail', [PasienController::class, 'detail'])->name('pasien.detail');
        Route::get('/tagihan/{no_registrasi}', [TagihanController::class, 'show'])->name('tagihan');
        // Route::get('/kwitansi/{no_registrasi}', [KwitansiController::class, 'show'])->name('kwitansi');
        Route::post('/billing', [BillingController::class, 'store'])->name('billing.store');
        Route::get('/pendaftaran/edit/{no_registrasi}', [PendaftaranController::class, 'editDarurat'])->name('pendaftaran.edit');
        Route::put('/pendaftaran/darurat/update', [PendaftaranController::class, 'updateDarurat'])->name('pendaftaran.updateDarurat');
    });

    Route::middleware(['role:dokter,perawat'])->group(function () {
        Route::get('/obat', [ObatController::class, 'tabelObat'])->name('obat');
        Route::get('/form-tindakan/{no_registrasi}', [TindakanController::class, 'formTindakan'])->name('form-tindakan');
        Route::get('/form-resep/{no_registrasi}', [ResepController::class, 'formResep'])->name('form-resep');
        Route::get('/form-diagnosa/{no_registrasi}', [DiagnosaController::class, 'create'])->name('form-diagnosa');
        Route::post('/diagnosa', [DiagnosaController::class, 'store'])->name('diagnosa.store');
        Route::post('/tindakan', [TindakanController::class, 'simpanTindakan'])->name('tindakan.simpan');
        Route::post('/resep', [ResepController::class, 'simpan'])->name('resep.simpan');
        Route::get('/resep', [ResepController::class, 'tabelResep'])->name('resep');
    });

    // Dokter
    Route::middleware(['role:dokter'])->group(function () {
        Route::get('/dashboard/dokter', [DashboardController::class, 'dokter'])->name('dashboard.dokter');
        Route::get('/obat-dokter', [ObatController::class, 'tabelObat'])->name('obat.dokter');
    });

    // Perawat
    Route::middleware(['role:perawat'])->group(function () {
        Route::get('/dashboard/perawat', [DashboardController::class, 'perawat'])->name('dashboard.perawat');
        Route::get('/obat-perawat', [ObatController::class, 'tabelObat'])->name('obat.perawat');
    });

    // Apoteker
    Route::middleware(['role:apoteker'])->group(function () {
        Route::get('/dashboard/apoteker', [DashboardController::class, 'apoteker'])->name('dashboard.apoteker');
        Route::get('/obat', [ObatController::class, 'tabelObatApoteker'])->name('obat.apoteker');
        Route::get('/obat-edit', [EditObatController::class, 'editObat'])->name('obat.edit');
        Route::put('/obat/update-semua', [EditObatController::class, 'updateSemua'])->name('obat.update.semua');
        Route::get('/resep-masuk', [ResepController::class, 'tabelResepApoteker'])->name('resep.apoteker');
        Route::put('/resep/{id_resep}/status', [ResepController::class, 'updateStatus'])->name('resep.updateStatus');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
