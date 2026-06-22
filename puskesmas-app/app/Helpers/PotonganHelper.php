<?php

namespace App\Helpers;

class PotonganHelper
{
    public static function hitung(string|null $kelas_bpjs, int $totalKotor): int
    {
        $persen = match($kelas_bpjs) {
            '1'     => 0.20,
            '2'     => 0.15,
            '3'     => 0.10,
            default => 0,
        };
        return round($totalKotor * $persen);
    }
}