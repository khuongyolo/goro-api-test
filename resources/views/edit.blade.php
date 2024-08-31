@extends('common.layout')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            @foreach ($errors->all() as $error)
                    <strong>※{{ $error }}</strong> <br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (Session::has('post.info'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <strong>{{ Session::pull('post.info') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4>Edit Post</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-text-paragraph"></i>Title</span>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Enter title">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-text"></i>Content</span>
                            <input type="text" class="form-control" id="content" name="content" value="{{ old('content', $post->content) }}" placeholder="Enter content">
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person-circle"></i>Author</span>
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $post->author) }}" placeholder="Enter author name">
                        </div>
                    </div>
                    <button class="btn btn-success w-100" type="submit">
                        <i class="bi bi-save"></i> Update
                    </button>
                </form>
            </div>
            <form action="{{ route('index') }}" method="">
                <button class="btn btn-outline-secondary text-nowrap px-4" type="submit">Back to Index</button>
            </form>
        </div>
    </div>
@endsection
