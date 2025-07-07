@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Minuman</h1>
    <form action="{{ route('minuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control" onchange="previewFoto(event)">
            <img id="preview-img" src="#" alt="Preview" style="display:none;max-width:200px;margin-top:10px;"/>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('minuman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script>
function previewFoto(event) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function(){
        var img = document.getElementById('preview-img');
        img.src = reader.result;
        img.style.display = 'block';
    };
    if(input.files[0]){
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
