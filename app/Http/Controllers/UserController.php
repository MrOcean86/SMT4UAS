<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id, $name)
    {
        return view('user.profile', compact('id', 'name'));
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:3',
        ]);
        \DB::table('users')->insert([
            'username' => $request->username,
            'password' => $request->password, // plain, bisa di-hash jika mau
            'role' => 'pembeli',
        ]);
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat, silakan login!');
    }
}
