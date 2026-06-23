<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfilController extends Controller
{
    public function index()
    {
        /** @var Akun $user */
        $user = Auth::user();
        $profil = $user->getProfil();

        return Inertia::render('Profil', [
            'profilData' => $profil,
            'username'   => $user->username,
            'role'       => $user->role,
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ]);

        /** @var Akun $user */
        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password_hash)) {
            return back()->withErrors(['password_lama' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password_hash' => Hash::make($request->password_baru),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}