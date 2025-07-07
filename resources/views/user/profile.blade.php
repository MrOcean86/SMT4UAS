@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>User Profile</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <img alt="Profile Picture">
            </div>
            <div class="col-md-8">
                <h5>User Information</h5>
                <table class="table">
                    <tr>
                        <th>ID:</th>
                        <td>{{ $id }}</td>
                    </tr>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 