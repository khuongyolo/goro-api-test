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

    @if (Session::has('newPost'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <strong>{{ Session::pull('newPost') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

     <form action="{{ route('addposts') }}" method="POST">
        @csrf
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title<span class="text-danger"> *required</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="content" class="col-sm-2 col-form-label">Content<span class="text-danger"> *required</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="content" value="{{ old('content') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="author" class="col-sm-2 col-form-label">Author<span class="text-danger"> *required</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="author" value="{{ old('author') }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
