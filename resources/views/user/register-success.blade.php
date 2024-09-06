@extends('user.layout')
@section('user.content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-success text-center">
                <h4 class="alert-heading">Registration Successful!</h4>
                <p>Thank you for registering. Please check your email to verify your account. An email has been sent with a verification link. If you do not see it, please check your spam or junk folder.</p>
                <hr>
                <p class="mb-0"><a href="{{ route('user.top') }}" class="btn btn-primary">Login here</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

@endsection
