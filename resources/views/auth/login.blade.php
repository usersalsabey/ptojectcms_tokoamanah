@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div>{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="/login">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <a href="/register">Daftar</a>
</div>
@endsection
