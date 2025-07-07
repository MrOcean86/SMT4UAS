@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Makanan</h1>
    <form action="{{ route('makanan.update', $makanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $makanan->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $makanan->harga }}" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $makanan->kategori }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $makanan->deskripsi }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('makanan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
