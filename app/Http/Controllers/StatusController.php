<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class StatusController extends Controller
{
    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->status = $request->status;
        $penjualan->save();
        return redirect()->back()->with('success', 'Status pesanan diperbarui!');
    }
} 