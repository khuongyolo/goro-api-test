@extends('common.layout')
@section('content')


    @if ($errors->any())
    @foreach ($errors->all() as $error)
        <strong>※{{ $error }}</strong> <br>
    @endforeach
    @endif

    @if (Session::has('newPost'))
        <p>{{ Session::pull('newPost') }}</p>
    @endif
    <div class="accordion" id="accordionExample">
        {{-- GET /api/index --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 1 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="{{ Session::get('collapse') == 1 ? true : false }}" aria-controls="collapse1">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/index</strong>
            </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse {{ Session::get('collapse') == 1 ? 'show' : '' }}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.index') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                        <div id="error-container">
                            <pre><code>
{
  "data": [
    {
      "id": 89,
      "title": "2123",
      "content": "awd",
      "author": "awd",
      "created_at": "2024-08-23T14:30:53.000000",
      "updated_at": "2024-08-23T14:30:53.000000"
    },
    {
      "id": 88,
      "title": "123",
      "content": "123",
      "author": "123",
      "created_at": "2024-08-23T13:54:15.000000Z",
      "updated_at": "2024-08-23T13:54:15.000000Z"
    },
    {
      "id": 87,
      "title": "adawdaw",
      "content": "awdawdawd",
      "author": "1111111",
      "created_at": "2024-08-23T13:50:18.000000Z",
      "updated_at": "2024-08-23T13:50:18.000000Z"
    },
  ]
}
                            </code></pre>
                        </div>


                </div>
            </div>
        </div>
        {{-- end GET /api/index --}}

        {{-- POST /api/index --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 2 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="{{ Session::get('collapse') == 2 ? true : false }}" aria-controls="collapse2">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/index</strong>
            </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse {{ Session::get('collapse') == 2 ? 'show' : '' }}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.index') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                        <div id="error-container">
                            <pre><code>
{
  "data": [
    {
      "id": 89,
      "title": "2123",
      "content": "awd",
      "author": "awd",
      "created_at": "2024-08-23T14:30:53.000000",
      "updated_at": "2024-08-23T14:30:53.000000"
    },
    {
      "id": 88,
      "title": "123",
      "content": "123",
      "author": "123",
      "created_at": "2024-08-23T13:54:15.000000Z",
      "updated_at": "2024-08-23T13:54:15.000000Z"
    },
    {
      "id": 87,
      "title": "adawdaw",
      "content": "awdawdawd",
      "author": "1111111",
      "created_at": "2024-08-23T13:50:18.000000Z",
      "updated_at": "2024-08-23T13:50:18.000000Z"
    },
  ]
}
                            </code></pre>
                        </div>
{{--  --}}

                </div>
            </div>
        </div>
        {{-- end POST /api/index --}}

        {{-- POST /api/addpost --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 3 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="{{ Session::get('collapse') == 3 ? true : false }}" aria-controls="collapse3">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/register</strong>
            </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse {{ Session::get('collapse') == 3 ? 'show' : '' }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form id="myForm" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="title" class="col-sm-2 col-form-label">Title<span class="text-danger"> *required</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="content" class="col-sm-2 col-form-label">Content<span class="text-danger"> *required</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="content">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="author" class="col-sm-2 col-form-label">Author<span class="text-danger"> *required</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="author">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('{{ route('register') }}')">Submit</button>
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('{{ route('api.register') }}')">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                    <h3>422 Unprocessable Entity</h3>
                        <div id="error-container">
                            <pre><code>
{
    "errors": {
        "title": [
            "The title is required."
        ],
        "content": [
            "The content is required."
        ],
        "author": [
            "The author field is required."
        ]
    }
}
                            </code></pre>
                        </div>
                                            <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
  "message": "Username is valid and saved successfully!"
}
                            </code></pre>
                        </div>


                </div>
            </div>
        </div>
        {{-- end /api/register --}}

        {{-- GET /api/edit --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 4 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="{{ Session::get('collapse') == 4 ? true : false }}" aria-controls="collapse4">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/edit/{id}</strong>
            </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse {{ Session::get('collapse') == 4 ? 'show' : '' }}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.index') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                        <div id="error-container">
                            <pre><code>
{
  "data": [
    {
      "id": 89,
      "title": "2123",
      "content": "awd",
      "author": "awd",
      "created_at": "2024-08-23T14:30:53.000000",
      "updated_at": "2024-08-23T14:30:53.000000"
    },
    {
      "id": 88,
      "title": "123",
      "content": "123",
      "author": "123",
      "created_at": "2024-08-23T13:54:15.000000Z",
      "updated_at": "2024-08-23T13:54:15.000000Z"
    },
    {
      "id": 87,
      "title": "adawdaw",
      "content": "awdawdawd",
      "author": "1111111",
      "created_at": "2024-08-23T13:50:18.000000Z",
      "updated_at": "2024-08-23T13:50:18.000000Z"
    },
  ]
}
                            </code></pre>
                        </div>
{{--  --}}

                </div>
            </div>
        </div>
        {{-- end GET /api/edit/{id} --}}

        {{-- POST /api/update --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 5 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="{{ Session::get('collapse') == 5 ? true : false }}" aria-controls="collapse5">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/update</strong>
            </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse {{ Session::get('collapse') == 5 ? 'show' : '' }}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.index') }}" method="GET">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                        <div id="error-container">
                            <pre><code>
{
  "data": [
    {
      "id": 89,
      "title": "2123",
      "content": "awd",
      "author": "awd",
      "created_at": "2024-08-23T14:30:53.000000",
      "updated_at": "2024-08-23T14:30:53.000000"
    },
    {
      "id": 88,
      "title": "123",
      "content": "123",
      "author": "123",
      "created_at": "2024-08-23T13:54:15.000000Z",
      "updated_at": "2024-08-23T13:54:15.000000Z"
    },
    {
      "id": 87,
      "title": "adawdaw",
      "content": "awdawdawd",
      "author": "1111111",
      "created_at": "2024-08-23T13:50:18.000000Z",
      "updated_at": "2024-08-23T13:50:18.000000Z"
    },
  ]
}
                            </code></pre>
                        </div>
                </div>
            </div>
        </div>
        {{-- end POST /api/update --}}

        {{-- GET/api/delete/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button {{ Session::get('collapse') != 6 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="{{ Session::get('collapse') == 6 ? true : false }}" aria-controls="collapse5">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/delete/{id}</strong>
            </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse {{ Session::get('collapse') == 6 ? 'show' : '' }}" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.delete', ['id' => $posts->first()->id]) }}" method="GET">
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-danger btn-sm">Submit API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                    <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
  "redirect": "/api/index",
  "message": "Post has been successfully deleted."
}
                            </code></pre>
                        </div>
                    <h3>500 Internal Server Error</h3>
                        <div id="error-container">
                            <pre><code>
{
  "redirect":'/api/index',
  "error": 'An unexpected error occurred',
  "message": $e->getMessage()
}
                            </code></pre>
                        </div>
                </div>
            </div>
        </div>
        {{-- end GET /api/delete/{id} --}}
    </div>
@endsection
<script>
    function setFormAction(action) {
        const form = document.getElementById('myForm');
        form.action = action;
    }
</script>
