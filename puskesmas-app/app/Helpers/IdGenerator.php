<?php
namespace App\Helpers;

use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\RekamMedis;
use App\Models\RekamMedisTindakan;
use App\Models\Billing;
use Carbon\Carbon;

class IdGenerator
{
    public static function generateNoRm(): string
    {
        $last = Pasien::orderByRaw('CAST(SUBSTRING(no_rm, 3) AS UNSIGNED) DESC')->first();
        $lastNum = $last ? (int) substr($last->no_rm, 2) : 0;
        $newNum = $lastNum + 1;
        if (!$last) return 'RM0001';
        $lastNum = (int) substr($last->no_rm, 2);
        $newNum = $lastNum + 1;
        // pastikan tidak duplikat
        while (Pasien::where('no_rm', 'RM' . str_pad($newNum, 4, '0', STR_PAD_LEFT))->exists()) {
            $newNum++;
        }
        return 'RM' . str_pad($newNum, 4, '0', STR_PAD_LEFT);
    }

    public static function generateNoRegistrasi(): string
    {
        $today = Carbon::now()->format('Ymd');

        $last = Pendaftaran::whereDate('tanggal_kunjungan', today())
            ->orderBy('no_registrasi', 'desc')
            ->first();

        if (!$last) {
            $nomor = 1;
        } else {
            $parts = explode('-', $last->no_registrasi);
            $nomor = (int) end($parts) + 1;
        }

        return 'REG-' . $today . '-' . str_pad($nomor, 2, '0', STR_PAD_LEFT);
    }

    // public static function generateIdRekamMedis(): string
    // {
    //     $last = RekamMedis::orderByRaw('CAST(SUBSTRING(id_rekam_medis, 3) AS UNSIGNED) DESC')->first();
    //     $lastNum = $last ? (int) substr($last->id_rekam_medis, 2) : 0;
    //     return 'RM' . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
    // }

    // public static function generateIdRekamMedisTindakan(): string
    // {
    //     $last = RekamMedisTindakan::orderByRaw('CAST(id AS UNSIGNED) DESC')->first();
    //     $lastNum = $last ? (int) $last->id : 0;
    //     return (string) ($lastNum + 1);
    // }

    // public static function generateIdBilling(): string
    // {
    //     $last = Billing::orderByRaw('CAST(SUBSTRING(id_billing, 4) AS UNSIGNED) DESC')->first();
    // }
    // public static function generateNoRegistrasi(): string
    // {
    //     $today = Carbon::now()->format('Ymd');
    //     $prefix = 'REG-' . $today . '-';
    //     $last = Pendaftaran::where('no_registrasi', 'like', $prefix . '%')
    //         ->orderBy('no_registrasi', 'desc')
    //         ->first();
    //     $lastNum = $last ? (int) substr($last->no_registrasi, -3) : 0;
    //     return $prefix . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);
    // }

    public static function generateIdRekamMedis(): string
    {
        $last = \App\Models\RekamMedis::orderByRaw('CAST(SUBSTRING(id_rekam_medis, 3) AS UNSIGNED) DESC')->first();
        $lastNum = $last ? (int) substr($last->id_rekam_medis, 2) : 0;
        return 'RM' . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
    }

    public static function generateIdRekamMedisTindakan(): string
    {
        $last = \App\Models\RekamMedisTindakan::orderByRaw('CAST(id AS UNSIGNED) DESC')->first();
        $lastNum = $last ? (int) $last->id : 0;
        return (string) ($lastNum + 1);
    }

    public static function generateIdBilling(): string
    {
        $last = \App\Models\Billing::orderByRaw('CAST(SUBSTRING(id_billing, 4) AS UNSIGNED) DESC')->first();
        $lastNum = $last ? (int) substr($last->id_billing, 3) : 0;
        return 'BIL' . str_pad($lastNum + 1, 4, '0', STR_PAD_LEFT);
    }

    public static function generateIdObat()
    {
        $last = \App\Models\Obat::orderBy('id_obat', 'desc')->first();

        if (!$last) {
            return 'OBT-001';
        }

        $number = (int) substr($last->id_obat, 4);
        $number++;

        return 'OBT-' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }
}