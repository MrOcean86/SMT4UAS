@extends('layouts.app')

@section('title', 'Baby & Kid')

@section('content')
<div>
    <h1>Baby & Kid Products</h1>
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
                    <td>Popok Bayi</td>
                    <td>Rp 75.000</td>
                    <td>30</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Susu Formula</td>
                    <td>Rp 150.000</td>
                    <td>25</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 