<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Obat;

class ObatController extends Controller
{
    public function tabelObat()
    {
        $obatDokter = Obat::all();

        return Inertia::render('TabelObat', [
            'obatDokter' => $obatDokter
        ]);
    }

    public function tabelObatApoteker()
    {
        $obat = Obat::all();

        return Inertia::render('TabelObatApoteker', [
            'obat' => $obat
        ]);
    }
}