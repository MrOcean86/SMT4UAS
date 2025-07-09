@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Menu Warung Makan</h1>
    <h3>Makanan</h3>
    <div class="row">
        @foreach($makanans as $makanan)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @php
                    $penjualanFoto = null;
                    if(isset($penjualans)) {
                        $penjualan = $penjualans->where('id_makanan', $makanan->id)->sortByDesc('tanggal')->first();
                        if($penjualan && $penjualan->foto) {
                            $penjualanFoto = $penjualan->foto;
                        }
                    }
                @endphp
                @if($penjualanFoto)
                    <img src="{{ asset('img/'.$penjualanFoto) }}" class="card-img-top" alt="foto penjualan" style="height:200px;object-fit:cover;">
                @elseif($makanan->foto)
                    <img src="{{ asset('img/'.$makanan->foto) }}" class="card-img-top" alt="foto makanan" style="height:200px;object-fit:cover;">
                @else
                    <img src="{{ asset('img/') }}" class="card-img-top" alt="no image" style="height:200px;object-fit:cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $makanan->nama }}</h5>
                    <p class="card-text">{{ $makanan->deskripsi }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($makanan->harga,0,',','.') }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $makanan->stok }}</p>
                    @if(session('user') && session('user')->role == 'admin')
                        {{-- Admin tidak bisa memesan, tidak tampil tombol pesan atau badge stok habis --}}
                    @elseif($makanan->stok > 0)
                        @if(session('user'))
                            <a href="{{ route('order.form', ['type'=>'makanan','id'=>$makanan->id]) }}" class="btn btn-success">Pesan</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success">Pesan</a>
                        @endif
                    @else
                        <span class="badge bg-danger">Stok Habis</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h3 class="mt-5">Minuman</h3>
    <div class="row">
        @foreach($minumen as $minuman)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if($minuman->foto)
                    <img src="{{ asset('img/'.$minuman->foto) }}" class="card-img-top" alt="foto minuman" style="height:200px;object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/200x200?text=No+Image" class="card-img-top" alt="no image" style="height:200px;object-fit:cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $minuman->nama }}</h5>
                    <p class="card-text">{{ $minuman->deskripsi }}</p>
                    <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($minuman->harga,0,',','.') }}</p>
                    <p class="card-text"><strong>Stok:</strong> {{ $minuman->stok }}</p>
                    @if(session('user') && session('user')->role == 'admin')
                        {{-- Admin tidak bisa memesan, tidak tampil tombol pesan atau badge stok habis --}}
                    @elseif($minuman->stok > 0)
                        <a href="{{ route('order.form', ['type'=>'minuman','id'=>$minuman->id]) }}" class="btn btn-success">Pesan</a>
                    @else
                        <span class="badge bg-danger">Stok Habis</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
