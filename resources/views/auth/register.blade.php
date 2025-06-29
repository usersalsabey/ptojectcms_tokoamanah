@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Register</h2>
    @if($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="/register">
        @csrf
        <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required><br>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br>
        <button type="submit">Register</button>
    </form>
    <a href="/login">Login</a>
</div>
@endsection