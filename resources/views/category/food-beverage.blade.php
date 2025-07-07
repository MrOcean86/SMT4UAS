@extends('layouts.app')

@section('title', 'Food & Beverage')

@section('content')
<div>
    <h1>Food & Beverage Products</h1>
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
                    <td>Nasi Goreng</td>
                    <td>Rp 25.000</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Es Teh</td>
                    <td>Rp 5.000</td>
                    <td>100</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 