<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Makanan;

class MakananController extends Controller
{
    public function index() {
        $makanans = Makanan::all();
        return view('makanan.index', compact('makanans'));
    }

    public function create() {
        return view('makanan.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'kategori' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only(['nama', 'harga', 'kategori', 'deskripsi']);

        // Cek jika ada file foto diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }

        Makanan::create($data);

        return redirect()->route('makanan.index')->with('success', 'Makanan berhasil ditambahkan');
    }

    public function edit($id) {
        $makanan = Makanan::findOrFail($id);
        return view('makanan.edit', compact('makanan'));
    }

    public function update(Request $request, $id) {
        $makanan = Makanan::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }
        $makanan->update($data);
        return redirect()->route('makanan.index');
    }

    public function destroy($id) {
        $makanan = Makanan::findOrFail($id);
        $makanan->delete();
        return redirect()->route('makanan.index');
    }
}
