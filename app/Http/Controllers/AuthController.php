<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && $request->password == $user->password) {
            Session::put('user', $user);
            if ($user->role == 'admin') {
                return redirect()->route('penjualan.index');
            } else {
                return redirect()->route('home');
            }
        }
        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->route('login');
    }
}
