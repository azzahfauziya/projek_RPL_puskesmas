<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Obat;

class ObatController extends Controller
{
    public function tabelObat()
    {
        $obat = Obat::all();

        return Inertia::render('TabelObat', [
            'obat' => $obat
        ]);
    }
}