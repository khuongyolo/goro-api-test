@if ($errors->any())
    @foreach ($errors->all() as $error)
        <strong>※{{ $error }}</strong> <br>
    @endforeach
@endif

@if (Session::has('newPost'))
    <p>{{ Session::pull('newPost') }}</p>
@endif

<form action="{{ route('addposts') }}" method="POST">
    @csrf
    <div>
        <label for="title">title</label>
        <input type="text" name="title" placeholder="(required)">
    </div>
    <div>
        <label for="content">content</label>
        <input type="text" name="content" placeholder="(required)">
    </div>
    <div>
        <label for="author">author</label>
        <input type="text" name="author" placeholder="(required)">
    </div>
    <button type="submit">Submit</button>
</form>
