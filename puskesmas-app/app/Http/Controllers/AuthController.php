<?php
namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return Inertia::render('Auth/Login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $akun = Akun::where('username', $request->username)->first();

        if (!$akun || !Hash::check($request->password, $akun->password_hash)) {
            return back()->withErrors([
                'username' => 'Username atau password salah.',
            ]);
        }

        Auth::login($akun);
        $akun->update(['last_login' => now()]);
        $request->session()->regenerate();

        // dd($akun->role, Auth::check(), Auth::user());
        return $this->redirectByRole($akun->role);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    private function redirectByRole(string $role)
    {
        return match($role) {
            'administrasi' => redirect()->route('dashboard.administrasi'),
            'dokter'       => redirect()->route('dashboard.dokter'),
            'apoteker'     => redirect()->route('dashboard.apoteker'),
            default        => redirect()->route('login'),
        };
    }
}