<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Minuman;

class MinumanController extends Controller
{
    public function index() {
        $minumen = Minuman::all();
        return view('minuman.index', compact('minumen'));
    }

    public function create() {
        return view('minuman.create');
    }

    public function store(Request $request) {
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $data['foto'] = $filename;
        }
        Minuman::create($data);
        return redirect()->route('minuman.index');
    }

    public function edit($id) {
        $minuman = Minuman::findOrFail($id);
        return view('minuman.edit', compact('minuman'));
    }

    public function update(Request $request, $id) {
        $minuman = Minuman::findOrFail($id);
        $minuman->update($request->all());
        return redirect()->route('minuman.index');
    }

    public function destroy($id) {
        $minuman = Minuman::findOrFail($id);
        $minuman->delete();
        return redirect()->route('minuman.index');
    }
}
