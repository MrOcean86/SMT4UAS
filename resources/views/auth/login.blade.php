@extends('layouts.app')
@section('content')
<div class="container" style="max-width:400px; margin-top:100px;">
    <h2 class="mb-4">Login</h2>
    @if($errors->has('login'))
        <div class="alert alert-danger">{{ $errors->first('login') }}</div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="mt-3 text-center">
        <a href="{{ route('register') }}">Buat Akun</a>
    </div>
</div>
@endsection
