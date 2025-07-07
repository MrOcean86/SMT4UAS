@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Daftar Minuman</h1>
    <a href="{{ route('minuman.create') }}" class="btn btn-primary mb-3">Tambah Minuman</a>
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
            @foreach($minumen as $minuman)
            <tr>
                <td>{{ $minuman->id }}</td>
                <td>{{ $minuman->nama }}</td>
                <td>{{ $minuman->harga }}</td>
                <td>{{ $minuman->kategori }}</td>
                <td>{{ $minuman->deskripsi }}</td>
                <td>
                    <a href="{{ route('minuman.edit', $minuman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('minuman.destroy', $minuman->id) }}" method="POST" style="display:inline-block;">
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
