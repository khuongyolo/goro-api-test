<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>GORO</title>
</head>
<body>
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
    
    WELCOME
<div class="d-flex align-items-center">
    @if (Auth::user()->avatar)
        <!-- Hiển thị avatar đã được lưu -->
        <img src="data:image/jpeg;base64,{{ Auth::user()->avatar }}" alt="Avatar của bạn" class="img-thumbnail" width="150">
    @else
        <!-- Hiển thị avatar mặc định nếu chưa có -->
        <img src="{{ asset('images/default-avatar.png') }}" alt="Avatar mặc định" class="img-thumbnail" width="150">
    @endif
    
    <!-- Nút đổi avatar -->
    <button type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">
        Đổi avatar
    </button>
</div>
<p>Name: {{ Auth::user()->name }}</p>
<p>Email: {{ Auth::user()->email }}</p>
<form action="{{ route('user.logout') }}">
    <button type="submit">LOGOUT</button>
</form>


<div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changeAvatarModalLabel">Đổi avatar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form tải ảnh avatar mới -->
          <form action="{{ route('user.changeAvatar') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                  <label for="avatar" class="form-label">Chọn ảnh avatar mới:</label>
                  <input class="form-control" type="file" name="avatar" id="avatar" accept="image/*" required>
              </div>
              <button type="submit" class="btn btn-success">Tải lên</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

