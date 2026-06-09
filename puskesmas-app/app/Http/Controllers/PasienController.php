<?php
namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PasienController extends Controller
{
public function dataPasien()
{
    $pasien = Pasien::orderBy('nama')->get();

    return Inertia::render('TabelDataPasien', [
        'pasien' => $pasien,
    ]);
}
}