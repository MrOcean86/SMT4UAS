@extends('layouts.app')

@section('title', 'Home Care')

@section('content')
<div>
    <h1>Home Care Products</h1>
    <div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pembersih Lantai</td>
                    <td>Rp 45.000</td>
                    <td>40</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Sabun Cuci Piring</td>
                    <td>Rp 20.000</td>
                    <td>85</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 