{{-- @extends('mail.layout')
@section('content')

    <h5 class="card-title">Verify Your Email Address</h5>
    <p class="card-text">To complete your registration, please click the button below to verify your email address.</p>
    <form action="{{ route('user.verify', ['verify_code' => $mailData['verify_code']]) }}" method="GET">
        <div class="row">
            <div class="col-sm-10 offset-sm-1">
                <button type="submit" class="btn btn-primary w-100">Verify Email</button>
            </div>
        </div>
    </form>

@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 5px;">
    <p style="color: #333; font-size: 16px;">Hello {{ $mailData['name'] }},</p>
    <h2 style="text-align: center; color: #333;">Verify Your Email Address</h2>
    <p style="color: #666; text-align: center;">To complete your registration, please click the button below to verify your email address.</p>
    <div style="text-align: center; margin-top: 30px;">
        <a href="{{ route('user.verify', ['verify_code' => $mailData['verify_code']]) }}" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Verify Email</a>
    </div>
</div>

</body>
</html>

