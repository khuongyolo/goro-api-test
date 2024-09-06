@extends('user.layout')
@section('user.content')
    <h2 class="text-center mb-4">Login</h2>

    <!-- UserID and Password Login Form -->
    <form action="/login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email or UserID</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or UserID" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

    <!-- Google OAuth Login Button -->
    <div class="d-grid">
        {{-- <a href="{{ route('google.login') }}" class="btn btn-danger"> --}}
        <a href="#" class="btn btn-danger">
            <i class="bi bi-google"></i> Login with Google
        </a>
    </div>

    <!-- Optional: Register Link -->
    <div class="text-center mt-3">
        <a href="{{ route('user.register') }}">Don't have an account? Register here</a>
    </div>
@endsection
