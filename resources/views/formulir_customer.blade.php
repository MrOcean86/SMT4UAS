@extends('layouts.app')
@section('content')
<div class="container" style="max-width:500px;">
    <h2 class="mb-4">Formulir Data Customer</h2>
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_pemesan" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" id="nama_pemesan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Pesanan</label>
            <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Proses Checkout</button>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali ke Keranjang</a>
    </form>
</div>
@endsection 