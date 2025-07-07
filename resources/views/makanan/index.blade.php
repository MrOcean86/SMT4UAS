@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Daftar Makanan</h1>
    <a href="{{ route('makanan.create') }}" class="btn btn-primary mb-3">Tambah Makanan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($makanans as $makanan)
            <tr>
                <td>{{ $makanan->id }}</td>
                <td>{{ $makanan->nama }}</td>
                <td>{{ $makanan->harga }}</td>
                <td>{{ $makanan->kategori }}</td>
                <td>{{ $makanan->deskripsi }}</td>
                <td>
                    <a href="{{ route('makanan.edit', $makanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('makanan.destroy', $makanan->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
