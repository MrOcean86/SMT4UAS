@extends('layouts.app')
@section('content')
<div class="container">
    <h1>History Penjualan</h1>
    <form method="GET" action="{{ route('historypenjualan.index') }}" class="row g-2 mb-3 align-items-end">
        <div class="col-md-2">
            <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}" placeholder="Tanggal">
        </div>
        <div class="col-md-2">
            <input type="text" name="nama_pemesan" class="form-control" value="{{ request('nama_pemesan') }}" placeholder="Nama Pemesan">
        </div>
        <div class="col-md-2">
            <input type="text" name="nama_pesanan" class="form-control" value="{{ request('nama_pesanan') }}" placeholder="Nama Pesanan">
        </div>
        <div class="col-md-2">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="sedang dimasak" {{ request('status') == 'sedang dimasak' ? 'selected' : '' }}>Sedang Dimasak</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="sort" class="form-label mb-0">Urutkan</label>
            <select name="sort" id="sort" class="form-select">
                <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
            </select>
        </div>
        <div class="col-md-2 d-flex gap-2">
            <button type="submit" class="btn btn-primary flex-fill">Filter</button>
            <a href="{{ route('historypenjualan.index') }}" class="btn btn-secondary flex-fill">Reset</a>
        </div>
    </form>
    
    {{-- Hapus form hapus terpilih dan kolom checkbox --}}
    <form action="{{ route('historypenjualan.deleteSelected') }}" method="POST" id="form-delete-selected" onsubmit="return confirm('Yakin ingin menghapus history yang dipilih?');">
        @csrf
        <button type="submit" class="btn btn-danger mb-3">Hapus Terpilih</button>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Nama Pesanan</th>
                <th>User ID Pembeli</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($penjualans as $penjualan)
        <tr>
            <td><input type="checkbox" form="form-delete-selected" name="selected[]" value="{{ $penjualan->id }}"></td>
            <td>{{ $penjualan->id }}</td>
            <td>{{ $penjualan->tanggal }}</td>
            <td>{{ $penjualan->makanan->nama ?? $penjualan->minuman->nama ?? '-' }}</td>
            <td>{{ $penjualan->user->id_user ?? '-' }}</td>
            <td>{{ $penjualan->nama_pemesan ?? '-' }}</td>
            <td>{{ $penjualan->alamat ?? '-' }}</td>
            <td>{{ $penjualan->no_hp ?? '-' }}</td>
            <td>{{ $penjualan->jumlah }}</td>
            <td>Rp{{ number_format($penjualan->total_harga,0,',','.') }}</td>
            <td>
                @if(session('user') && session('user')->role == 'admin')
                    <form method="POST" action="{{ route('penjualan.updateStatus', $penjualan->id) }}" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="menunggu" {{ $penjualan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="sedang dimasak" {{ $penjualan->status == 'sedang dimasak' ? 'selected' : '' }}>Sedang Dimasak</option>
                            <option value="selesai" {{ $penjualan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </form>
                @else
                    <span class="badge bg-secondary">{{ ucfirst($penjualan->status) }}</span>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $penjualans->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

<script>
document.getElementById('checkAll').onclick = function() {
    var checkboxes = document.querySelectorAll('input[name="selected[]"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};
</script>