@extends('user.layout')
@section('user.content')
    <h2 class="text-center mb-4">Register</h2>

    <!-- Registration Form -->
    <form action="{{ route('user.register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email or UserID" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password">
        </div>
        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>

    <!-- Optional: Login Link -->
    <div class="text-center mt-3">
        <a href="{{ route('user.top') }}">Already have an account? Login here</a>
    </div>
@endsection
