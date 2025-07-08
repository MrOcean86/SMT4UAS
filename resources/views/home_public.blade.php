@extends('layouts.app')
@section('content')
<style>
    body {
        background: url('{{ asset('img/background.jpeg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    .welcome-home {
        background: rgba(255,255,255,0.85);
        border-radius: 18px;
        max-width: 600px;
        margin: 80px auto 0 auto;
        padding: 40px 30px 30px 30px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
    .welcome-home h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 18px;
    }
    .welcome-home p.lead {
        font-size: 1.2rem;
        margin-bottom: 24px;
    }
    .welcome-home hr {
        margin: 24px 0;
    }
    .welcome-home h4 {
        margin-top: 18px;
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>
<div class="welcome-home text-center">
    <h1>Selamat Datang di Restoran Sederhana</h1>
    <p class="lead">Restoran Sederhana adalah tempat terbaik untuk menikmati makanan dan minuman lezat dengan harga terjangkau. Kami menyediakan berbagai menu favorit keluarga, mulai dari makanan tradisional hingga minuman segar.</p>
    <hr>
    <h4>Alamat</h4>
    <p>Jl. Cokolio,Kepanjen, Kota Anda</p>
    <h4>Jam Operasional</h4>
    <p>Setiap hari, 09.00 - 22.00 WIB</p>
    <h4>Kontak</h4>
    <p>Telepon: 0896-8181-9685</p>
</div>
@endsection
