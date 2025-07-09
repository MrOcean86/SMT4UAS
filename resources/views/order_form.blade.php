@extends('layouts.app')
@section('content')
<div class="container" style="max-width:500px;">
    <h2>Form Pesan {{ ucfirst($type) }}</h2>
    <div class="card mb-3">
        @if($item->foto)
            <img src="{{ asset('img/'.$item->foto) }}" class="card-img-top" alt="foto {{ $type }}" style="height:200px;object-fit:cover;">
        @else
            <img src="{{ asset('img/1750303581_20.jpg') }}" class="card-img-top" alt="no image" style="height:200px;object-fit:cover;">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $item->nama }}</h5>
            <p class="card-text">{{ $item->deskripsi }}</p>
            <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($item->harga,0,',','.') }}</p>
            <p class="card-text"><strong>Stok Tersisa:</strong> {{ $item->stok }}</p>
        </div>
    </div>
    <form action="{{ route('order.submit', ['type'=>$type, 'id'=>$item->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
        </div>
        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
        <a href="/" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
