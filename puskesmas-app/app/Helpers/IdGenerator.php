<?php
namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class IdGenerator
{
    /**
     * Generate ID format: PREFIX-001, PREFIX-002, dst
     * Contoh: DKT-001, ADM-001, OBT-001
     */
    public static function generate(string $prefix, string $table, string $column): string
    {
        $last = DB::table($table)->orderByDesc($column)->value($column);
        $num = $last ? (int) substr($last, strlen($prefix) + 1) + 1 : 1;
        return $prefix . '-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Generate nomor registrasi format: REG-YYYYMMDD-001
     * Reset tiap hari, jadi tiap hari mulai dari 001 lagi
     */
    public static function generateRegistrasi(): string
    {
        $date = now()->format('Ymd');
        $prefix = "REG-{$date}";
        $last = DB::table('pendaftaran')
            ->where('no_registrasi', 'like', "{$prefix}%")
            ->orderByDesc('no_registrasi')
            ->value('no_registrasi');
        $num = $last ? (int) substr($last, -3) + 1 : 1;
        return $prefix . '-' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    // public static function generateNoRm(): string
    // {
    //     $last = Pasien::orderByDesc('no_rm')->first();

    //     if (!$last) {
    //         return 'RM-000001';
    //     }

    //     $lastNumber = (int) substr($last->no_rm, 3);
    //     $newNumber = $lastNumber + 1;

    //     return 'RM-' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);
    // }
}