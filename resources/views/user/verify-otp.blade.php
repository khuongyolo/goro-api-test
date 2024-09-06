<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <strong>※{{ $error }}</strong> <br>
    @endforeach
    @endif
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg p-4">
                    <h2 class="text-center mb-4">Enter OTP</h2>
                    <p class="text-center mb-4">We have sent a One-Time Password (OTP) to your registered email. Please enter it below to verify your account.</p>

                    <!-- OTP Form -->
                    <form action="{{ route('user.verifyotp') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter your OTP" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Verify OTP</button>
                        </div>
                    </form>

                    <!-- Resend OTP Link -->
                    <div class="text-center mt-3">
                        <a href="/resend-otp">Didn't receive the OTP? Resend</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
