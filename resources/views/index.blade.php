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
    <h1>Index</h1>
    <div class="table-responsive">
        <div class="col-auto mb-5">
            <form action="{{ route('register') }}" method="">
                <button class="btn btn-success shadow text-nowrap float-end px-4" type="submit">Register</button>
            </form>
        </div>
        {{-- Search --}}
        <form action="{{ route('index') }}" method="POST">
        @csrf
            <div class="row mb-3">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by Title" name="searchString[title]" value="{{ Session::get('post.searchString')['title'] }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by Content" name="searchString[content]" value="{{ Session::get('post.searchString')['content'] }}">
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Search by Author" name="searchString[author]" value="{{ Session::get('post.searchString')['author'] }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary" type="submit">Search</button>
                    <button class="btn btn-secondary" type="button" onclick="clearSearch()">Clear</button>
                </div>
            </div>
        </form>

        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->content }}</td>
                        <td>{{ $post->author }}</td>
                        <td>
                            <a href="{{ route('edit', ['id' => $post->id]) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('delete', ['id' => $post->id]) }}" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function clearSearch() {
            document.querySelectorAll('input[name="searchString[title]"], input[name="searchString[content]"], input[name="searchString[author]"]').forEach(input => {
                input.value = ''; // Clear input values of title, content, and author
            });
        }
    </script>

@endsection


