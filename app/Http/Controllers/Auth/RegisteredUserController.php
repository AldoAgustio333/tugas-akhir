<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'jk' => ['required', 'in:Laki-laki,Perempuan'],
            'no_hp' => ['required', 'string', 'max:20'],
            'status' => ['required', 'in:mahasiswa,umum'],
            'npm' => ['nullable', 'string', 'max:20'],
            'fakultas' => ['nullable', 'string', 'max:255'],
            'program_studi' => ['nullable', 'string', 'max:255'],
            'kelas' => ['nullable', 'string', 'max:100'],
        ]);

        // Normalisasi status untuk memastikan konsistensi
        $status = strtolower($request->status);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jk' => $request->jk,
            'no_hp' => $request->no_hp,
            'status' => $status, // Gunakan status yang sudah dinormalisasi
            'npm' => $status === 'mahasiswa' ? $request->npm : null,
            'fakultas' => $status === 'mahasiswa' ? $request->fakultas : null,
            'program_studi' => $status === 'mahasiswa' ? $request->program_studi : null,
            'kelas' => $status === 'mahasiswa' ? $request->kelas : null,
            'role' => 'user',
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
