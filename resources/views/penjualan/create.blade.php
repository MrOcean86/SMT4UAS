@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Penjualan</h1>
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Makanan</label>
            <select name="id_makanan" class="form-control" required>
                @foreach($makanans as $makanan)
                    <option value="{{ $makanan->id }}">{{ $makanan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Total Harga</label>
            <input type="number" name="total_harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
