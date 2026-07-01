<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Simpan user baru
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required',
        'nohp' => 'required',
        'alamat' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'nohp' => $request->nohp,
        'alamat' => $request->alamat,
    ]);

    return back()->with('success','User berhasil ditambahkan');
}

    /**
     * Update User
     */
   public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required',
        'nohp' => 'required',
        'alamat' => 'required'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'nohp' => $request->nohp,
        'alamat' => $request->alamat,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return back()->with('success','User berhasil diupdate');
}
    /**
     * Hapus User
     */
    public function destroy(User $user)
    {
        // Hindari admin menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}