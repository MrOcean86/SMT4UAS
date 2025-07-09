<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Models\Makanan;
use App\Models\Minuman;
use App\Models\Penjualan;

// route untuk URL hanya /'
Route::get('/', function () {
    $makanans = Makanan::all();
    $minumen = Minuman::all();
    return view('home_public', compact('makanans', 'minumen'));
})->name('home');

// User Routes
Route::get('/user/{id}/name/{name}', [UserController::class, 'show'])->name('user.show');
Route::get('/register', [App\Http\Controllers\UserController::class, 'registerForm'])->name('register');
Route::post('/register', [App\Http\Controllers\UserController::class, 'register']);

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth.session'])->group(function () {
    Route::resource('makanan', MakananController::class);
    Route::resource('minuman', MinumanController::class);
    Route::resource('penjualan', PenjualanController::class);
});

Route::get('/order/{type}/{id}', function($type, $id) {
    if ($type == 'makanan') {
        $item = Makanan::findOrFail($id);
    } else {
        $item = Minuman::findOrFail($id);
    }
    return view('order_form', compact('item', 'type'));
})->name('order.form');

Route::post('/order/{type}/{id}', function(Illuminate\Http\Request $request, $type, $id) {
    if ($type == 'makanan') {
        $item = \App\Models\Makanan::findOrFail($id);
    } else {
        $item = \App\Models\Minuman::findOrFail($id);
    }
    $cart = session('cart', []);
    $cart[] = [
        'id' => $item->id,
        'type' => $type,
        'nama' => $item->nama,
        'harga' => $item->harga,
        'jumlah' => $request->jumlah,
        'nama_pemesan' => $request->nama_pemesan
    ];
    session(['cart' => $cart]);
    return redirect()->route('cart.index')->with('success', 'Berhasil ditambahkan ke keranjang!');
})->name('order.submit');

// Ganti route historypenjualan agar mendukung filter
Route::get('/historypenjualan', [\App\Http\Controllers\PenjualanController::class, 'history'])->name('historypenjualan.index');

Route::get('/penjualan', function() {
    $makanans = Makanan::all();
    $minumen = Minuman::all();
    return view('penjualan.index', compact('makanans', 'minumen'));
})->name('penjualan.index');

// Route untuk keranjang belanja
Route::get('/cart', function() {
    $cart = session('cart', []);
    return view('cart', compact('cart'));
})->name('cart.index');

Route::get('/cart/customer', function() {
    return view('formulir_customer');
})->name('cart.customer');

Route::post('/cart/checkout', function(Illuminate\Http\Request $request) {
    $cart = session('cart', []);
    $id_user = session('user')->id_user ?? null;
    $nama_pemesan = $request->nama_pemesan;
    $alamat = $request->alamat;
    $no_hp = $request->no_hp;
    foreach ($cart as $item) {
        if ($item['type'] == 'makanan') {
            $makanan = \App\Models\Makanan::find($item['id']);
            if ($makanan && $makanan->stok >= $item['jumlah']) {
                $makanan->stok -= $item['jumlah'];
                $makanan->save();
                \App\Models\Penjualan::create([
                    'tanggal' => now(),
                    'id_makanan' => $item['id'],
                    'id_minuman' => null,
                    'id_user' => $id_user,
                    'jumlah' => $item['jumlah'],
                    'total_harga' => $item['harga'] * $item['jumlah'],
                    'nama_pemesan' => $nama_pemesan,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp
                ]);
            } else {
                return redirect()->route('cart.index')->with('error', 'Stok makanan tidak cukup untuk ' . $item['nama']);
            }
        } else if ($item['type'] == 'minuman') {
            $minuman = \App\Models\Minuman::find($item['id']);
            if ($minuman && $minuman->stok >= $item['jumlah']) {
                $minuman->stok -= $item['jumlah'];
                $minuman->save();
                \App\Models\Penjualan::create([
                    'tanggal' => now(),
                    'id_makanan' => null,
                    'id_minuman' => $item['id'],
                    'id_user' => $id_user,
                    'jumlah' => $item['jumlah'],
                    'total_harga' => $item['harga'] * $item['jumlah'],
                    'nama_pemesan' => $nama_pemesan,
                    'alamat' => $alamat,
                    'no_hp' => $no_hp
                ]);
            } else {
                return redirect()->route('cart.index')->with('error', 'Stok minuman tidak cukup untuk ' . $item['nama']);
            }
        }
    }
    session()->forget('cart');
    return redirect()->route('thankyou');
})->name('cart.checkout');

Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');

Route::post('/cart/update/{index}', function(Illuminate\Http\Request $request, $index) {
    $cart = session('cart', []);
    if (isset($cart[$index])) {
        $cart[$index]['jumlah'] = max(1, (int)$request->jumlah);
        session(['cart' => $cart]);
    }
    return redirect()->route('cart.index');
})->name('cart.update');

Route::post('/historypenjualan/deleteSelected', function(Illuminate\Http\Request $request) {
    $ids = $request->selected;
    if ($ids && is_array($ids)) {
        \App\Models\Penjualan::whereIn('id', $ids)->delete();
    }
    return redirect()->route('historypenjualan.index')->with('success', 'History terpilih berhasil dihapus!');
})->name('historypenjualan.deleteSelected');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');

// Route untuk update status penjualan (hanya admin, PATCH)
Route::middleware(['auth.session'])->patch('/penjualan/{id}/status', [\App\Http\Controllers\StatusController::class, 'update'])->name('penjualan.updateStatus');

// Route untuk status pesanan user
Route::get('/status-pesanan', [\App\Http\Controllers\UserController::class, 'statusPesanan'])->name('user.status_pesanan');
