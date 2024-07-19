@error('username')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
<form action="{{ route('username') }}" method="POST">
    @csrf
    <input type="text" name="username">
    <button type="submit">Gửi</button>
</form>
