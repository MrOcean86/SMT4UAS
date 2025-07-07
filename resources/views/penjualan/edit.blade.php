@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Edit Penjualan</h1>
    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $penjualan->tanggal }}" required>
        </div>
        <div class="mb-3">
            <label>Makanan</label>
            <select name="id_makanan" class="form-control" required>
                @foreach($makanans as $makanan)
                    <option value="{{ $makanan->id }}" @if($penjualan->id_makanan == $makanan->id) selected @endif>{{ $makanan->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $penjualan->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label>Total Harga</label>
            <input type="number" name="total_harga" class="form-control" value="{{ $penjualan->total_harga }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
