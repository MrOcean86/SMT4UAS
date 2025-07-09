@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-3">
        <h2 class="mb-0">Keranjang Belanja</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(count($cart) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $index => $item)
            @php
                $stok = null;
                if($item['type'] == 'makanan') {
                    $stok = \App\Models\Makanan::find($item['id'])->stok ?? 0;
                } else if($item['type'] == 'minuman') {
                    $stok = \App\Models\Minuman::find($item['id'])->stok ?? 0;
                }
            @endphp
            <tr>
                <td>{{ $item['nama'] }}</td>
                <td>
                    <form action="{{ route('cart.update', $index) }}" method="POST" class="d-flex align-items-center" style="gap:4px;">
                        @csrf
                        <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" min="1" max="{{ $stok }}" class="form-control form-control-sm" style="width:70px;">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                    @if($item['jumlah'] > $stok)
                        <div class="text-danger small">Stok tidak mencukupi (maksimal {{ $stok }})</div>
                    @endif
                </td>
                <td>Rp{{ number_format($item['harga'],0,',','.') }}</td>
                <td>Rp{{ number_format($item['harga'] * $item['jumlah'],0,',','.') }}</td>
                <td>
                    <form action="{{ route('cart.remove', $index) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus item ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @php
        $totalHarga = 0;
        foreach ($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }
    @endphp
    <div class="text-end mb-3">
        <strong>Total Harga: Rp{{ number_format($totalHarga,0,',','.') }}</strong>
    </div>
    <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
        @csrf
        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('cart.customer') }}" class="btn btn-success">Checkout</a>
            <a href="/smt4uas/public/penjualan" class="btn btn-secondary">Tambahkan Item Lainnya</a>
        </div>
    </form>
    @else
        <p>Keranjang kosong.</p>
    @endif
</div>
@endsection 