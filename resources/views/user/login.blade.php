@extends('user.layout')
@section('user.content')

@if (Cache::has('user.info'))
    <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
        <strong>{{ Cache::pull('user.info') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <h2 class="text-center mb-4">Login</h2>

    <!-- UserID and Password Login Form -->
    <form action="{{ route('user.login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or UserID" >
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" >
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

    <!-- Google OAuth Login Button -->
    <div class="d-grid">
        {{-- <a href="{{ route('google.login') }}" class="btn btn-danger"> --}}
        <a href = {{ route('user.login.redirect') }} class="btn btn-danger">
            <i class="bi bi-google"></i> Login with Google
        </a>
    </div>

    <!-- Optional: Register Link -->
    <div class="text-center mt-3">
        <a href="{{ route('user.register') }}">Don't have an account? Register here</a>
    </div>
@endsection
