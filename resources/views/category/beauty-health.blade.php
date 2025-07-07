@extends('layouts.app')

@section('title', 'Beauty & Health')

@section('content')
<div>
    <h1>Beauty & Health Products</h1>
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
                    <td>Sabun Mandi</td>
                    <td>Rp 15.000</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Shampoo</td>
                    <td>Rp 35.000</td>
                    <td>60</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 