@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Minuman</h1>
    <form action="{{ route('minuman.update', $minuman->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $minuman->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $minuman->harga }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $minuman->kategori }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $minuman->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ $minuman->stok }}" min="0" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('minuman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
