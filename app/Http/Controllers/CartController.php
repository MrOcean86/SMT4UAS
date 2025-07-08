<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Tampilkan halaman cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Hapus item dari cart
    public function remove($index)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$index])) {
            unset($cart[$index]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    // Tambahkan method lain sesuai kebutuhan (update, checkout, dll)
}