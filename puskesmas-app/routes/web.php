<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
//->middleware(['auth', 'verified'])->name('dashboard')
;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

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