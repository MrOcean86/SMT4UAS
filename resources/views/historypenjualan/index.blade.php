@extends('layouts.app')
@section('content')
<div class="container">
    <h1>History Penjualan</h1>
    <form action="{{ route('historypenjualan.deleteSelected') }}" method="POST" id="form-delete-selected" onsubmit="return confirm('Yakin ingin menghapus history yang dipilih?');">
        @csrf
        <!-- Form ini hanya untuk hapus terpilih, method POST -->
        <button type="submit" class="btn btn-danger mb-3">Hapus Terpilih</button>
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
                <td><input type="checkbox" name="selected[]" value="{{ $penjualan->id }}"></td>
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
                    <!-- Form update status mengarah ke StatusController -->
                    <form action="{{ route('penjualan.updateStatus', $penjualan->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option value="menunggu" {{ $penjualan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="sedang dimasak" {{ $penjualan->status == 'sedang dimasak' ? 'selected' : '' }}>Sedang Dimasak</option>
                            <option value="selesai" {{ $penjualan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </form>
    <script>
    document.getElementById('checkAll').onclick = function() {
        var checkboxes = document.querySelectorAll('input[name="selected[]"]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    };
    </script>
</div>
@endsection
