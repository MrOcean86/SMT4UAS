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

    public function statusPesanan()
    {
        $user = session('user');
        $penjualans = [];
        if ($user) {
            $query = \App\Models\Penjualan::with(['makanan', 'minuman'])
                ->where('id_user', $user->id_user);
            $tanggal_awal = request('tanggal_awal');
            $tanggal_akhir = request('tanggal_akhir');
            if ($tanggal_awal) {
                $query->where('tanggal', '>=', $tanggal_awal);
            }
            if ($tanggal_akhir) {
                $query->where('tanggal', '<=', $tanggal_akhir);
            }
            $penjualans = $query->orderByDesc('tanggal')->get();
        }
        return view('user.status_pesanan', compact('penjualans'));
    }
}
