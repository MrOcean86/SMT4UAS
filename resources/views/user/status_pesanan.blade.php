@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Status Pesanan Saya</h2>
    <form method="GET" class="row g-3 mb-3">
        <div class="col-auto">
            <label for="tanggal_awal" class="form-label">Dari Tanggal</label>
            <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
        </div>
        <div class="col-auto">
            <label for="tanggal_akhir" class="form-label">Sampai Tanggal</label>
            <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
        </div>
        <div class="col-auto align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('user.status_pesanan') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
    @if(count($penjualans) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pesanan</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penjualans as $penjualan)
            <tr>
                <td>{{ $penjualan->tanggal }}</td>
                <td>{{ $penjualan->makanan->nama ?? $penjualan->minuman->nama ?? '-' }}</td>
                <td>{{ $penjualan->jumlah }}</td>
                <td>Rp{{ number_format($penjualan->total_harga,0,',','.') }}</td>
                <td>
                    @if($penjualan->status == 'menunggu')
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @elseif($penjualan->status == 'sedang dimasak')
                        <span class="badge bg-info text-dark">Sedang Dimasak</span>
                    @elseif($penjualan->status == 'selesai')
                        <span class="badge bg-success">Selesai</span>
                    @else
                        <span class="badge bg-secondary">-</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-info">Belum ada pesanan.</div>
    @endif
</div>
@endsection 