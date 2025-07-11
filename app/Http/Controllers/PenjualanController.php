<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Makanan;

class PenjualanController extends Controller
{
    public function index() {
        $penjualans = Penjualan::all();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create() {
        $makanans = Makanan::all();
        return view('penjualan.create', compact('makanans'));
    }

    public function store(Request $request) {
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }
        $data['status'] = 'menunggu'; 
        Penjualan::create($data);
        return redirect()->route('penjualan.index');
    }

    public function edit($id) {
        $penjualan = Penjualan::findOrFail($id);
        $makanans = Makanan::all();
        return view('penjualan.edit', compact('penjualan', 'makanans'));
    }

    public function update(Request $request, $id) {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update($request->all());
        return redirect()->route('penjualan.index');
    }

    public function destroy($id) {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();
        return redirect()->route('penjualan.index');
    }

    // History penjualan dengan filter
    public function history(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Penjualan::with(['makanan', 'user', 'minuman']);
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }
        if ($request->filled('nama_pemesan')) {
            $query->where('nama_pemesan', 'like', '%'.$request->nama_pemesan.'%');
        }
        if ($request->filled('nama_pesanan')) {
            $query->where(function($q) use ($request) {
                $q->whereHas('makanan', function($q2) use ($request) {
                    $q2->where('nama', 'like', '%'.$request->nama_pesanan.'%');
                })
                ->orWhereHas('minuman', function($q2) use ($request) {
                    $q2->where('nama', 'like', '%'.$request->nama_pesanan.'%');
                });
            });
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        $sort = $request->get('sort', 'desc');
        $penjualans = $query->orderBy('tanggal', $sort)->paginate(10)->withQueryString();
        return view('historypenjualan.index', compact('penjualans'));
    }
}
