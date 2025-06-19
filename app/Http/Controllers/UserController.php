<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function dashboard() 
    {
        
        return view('user.dashboard');
    }   

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        logger('Store User Request: ', $request->all());

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'jk' => 'required',
            'no_hp' => 'required',
            'status' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'jk' => $request->jk,
            'no_hp' => $request->no_hp,
            'status' => $request->status,
            'role' => $request->role
        ]);

        logger('User created: ', $user->toArray());

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan!');
    }


    public function updateUser(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$id,
        'jk' => 'required|in:Laki-laki,Perempuan',
        'no_hp' => 'nullable|string|max:20',
        'status' => 'nullable|string|max:50',
        'role' => 'required|in:admin,ketua_uld,user',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->jk = $request->jk;
    $user->no_hp = $request->no_hp;
    $user->status = $request->status;
    $user->role = $request->role;
    $user->save();

    return redirect()->back()->with('success', 'Data user berhasil diperbarui!');
}



    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

     public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

    public function updateFoto(Request $request)
{
    $request->validate([
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = auth()->user();

    // Hapus foto lama jika ada
      if ($user->foto && file_exists(public_path('uploads/' . $user->foto))) {
        unlink(public_path('uploads/' . $user->foto));
    }

    // Simpan foto baru
    $file = $request->file('foto');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads'), $filename);

    // Update database
    $user->update(['foto' => $filename]);

    return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
}

public function updateProfil(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'no_hp' => 'nullable|string|max:20',
        'jk' => 'required|in:Laki-laki,Perempuan',
        'status' => 'required|in:mahasiswa,umum',
        'npm' => 'nullable|string|max:20',
        'fakultas' => 'nullable|string|max:100',
        'program_studi' => 'nullable|string|max:100',
        'kelas' => 'nullable|string|max:100',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    // Update data profil
    $user->update($request->except('foto'));

    // Simpan foto jika ada upload baru
    if ($request->hasFile('foto')) {
        if ($user->foto && file_exists(public_path('uploads/' . $user->foto))) {
            unlink(public_path('uploads/' . $user->foto));
        }

        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $user->foto = $filename;
        $user->save();
    }

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}



}
