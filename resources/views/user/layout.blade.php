<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-md-6 mx-auto">
                <div class="card shadow-lg p-4">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <strong>※{{ $error }}</strong> <br>
                        @endforeach
                    @endif

                    @if (Session::has('user.info'))
                        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
                            <strong>{{ Session::pull('user.info') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @yield('user.content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
