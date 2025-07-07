@extends('layouts.app')
@section('content')
<div class="container" style="max-width:500px;">
    <h2>Edit Data Makanan</h2>
    <form action="{{ route('historypenjualan.update', $makanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Makanan</label>
            <input type="text" name="nama" class="form-control" value="{{ $makanan->nama }}" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $makanan->harga }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('historypenjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
