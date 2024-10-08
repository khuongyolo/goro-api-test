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

     <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Register Form</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title<span class="text-danger"> *required</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            {{-- @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="content" class="col-sm-2 col-form-label">Content<span class="text-danger"> *required</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="content" name="content" value="{{ old('content') }}">
                            {{-- @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Author<span class="text-danger"> *required</span></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}">
                            {{-- @error('author')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="container mt-3">
        <form action="{{ route('index') }}" method="">
            <button class="btn btn-outline-secondary text-nowrap px-4" type="submit">Back to Index</button>
        </form>
    </div>
@endsection
