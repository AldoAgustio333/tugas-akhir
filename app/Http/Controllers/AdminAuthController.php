<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (in_array(Auth::user()->role, ['admin', 'ketua_uld'])) {
                return redirect()->intended(route('admin.dashboard'));
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', 'Tidak punya akses ke halaman admin.');


            }
        }

        return redirect()->route('admin.login')->with('error', 'Email atau password salah.');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

