<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\ResepController;

// Redirect root ke login
Route::get('/', fn() => redirect()->route('login'));

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard/administrasi', function () {
//     return Inertia::render('Dashboard/Administrasi');
// })
// ->middleware(['auth', 'verified'])->name('dashboard.administrasi')
// ;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard administrasi — hanya bisa diakses role administrasi
    Route::middleware(['auth', 'role:administrasi'])->group(function () {
        Route::get('/dashboard/administrasi', [DashboardController::class, 'administrasi'])
            ->name('dashboard.administrasi');

        Route::get('/data-pasien', [PasienController::class, 'dataPasien'])  // ← ganti dari closure
            ->name('data-pasien');
        Route::get('/antrian', [AntrianController::class, 'daftarAntrian'])  // ← ganti dari closure
            ->name('antrian');
        Route::get('/detail-pasien/{no_registrasi}', [PasienController::class, 'detailPasien'])
            ->name('detail-pasien');
    });

    Route::middleware(['auth', 'role:dokter'])->group(function () {
        Route::get('/dashboard/dokter', [DashboardController::class, 'dokter'])
            ->name('dashboard.dokter');

        Route::get('/data-pasien', [PasienController::class, 'dataPasien'])  // ← ganti dari closure
            ->name('data-pasien');
        Route::get('/antrian', [AntrianController::class, 'daftarAntrian'])  // ← ganti dari closure
            ->name('antrian');
        Route::get('/obat', [ObatController::class, 'tabelObat'])
            ->name('obat');
        Route::get('/detail-pasien/{no_registrasi}', [PasienController::class, 'detailPasien'])
            ->name('detail-pasien');
        Route::get('/form-tindakan/{no_registrasi}', [TindakanController::class, 'formTindakan'])
            ->name('form-tindakan');
        Route::get('/form-resep/{no_registrasi}', [ResepController::class, 'formResep'])
            ->name('form-resep');
        Route::post('/tindakan', [TindakanController::class, 'simpanTindakan'])
            ->name('tindakan.simpan');
        Route::post('/resep', [ResepController::class, 'simpan'])
            ->name('resep.simpan');
        Route::get('/resep', [ResepController::class, 'tabelResep'])
            ->name('resep');
    });
    
    Route::middleware(['auth', 'role:apoteker'])->group(function () {
        Route::get('/dashboard/apoteker', [DashboardController::class, 'apoteker'])
            ->name('dashboard.apoteker');

    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



});

//require __DIR__.'/auth.php';


Route::get('/TabelObat', function () {
    return Inertia::render('TabelObat');
});

Route::get('/TabelObatApoteker', function () {
    return Inertia::render('TabelObatApoteker');
});

Route::get('/EditTabelObat', function () {
    return Inertia::render('EditTabelObat');
});

Route::get('/TabelResepApoteker', function () {
    return Inertia::render('TabelResepApoteker');
});

Route::get('/TabelResepPerawat', function () {
    return Inertia::render('TabelResepPerawat');
});

Route::get('/Tagihan', function () {
    return Inertia::render('Tagihan');
});

Route::get('/Kwitansi', function () {
    return Inertia::render('Kwitansi');
});

Route::get('/Histori', function () {
    return Inertia::render('Histori');
});

Route::get('/DataPasien', function () {
    return Inertia::render('DataPasien');
});

Route::get('/TabelAntrian', function () {
    return Inertia::render('TabelAntrian');
});

Route::get('/FormDiagnosa', function () {
    return Inertia::render('FormDiagnosa');
});

Route::get('/FormTindakan', function () {
    return Inertia::render('FormTindakan');
});

Route::get('/FormResep', function () {
    return Inertia::render('FormResep');
});

Route::get('/FormDaftar', function () {
    return Inertia::render('FormDaftar');
});

Route::get('/DetailPasien', function () {
    return Inertia::render('DetailPasien');
});