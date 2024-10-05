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
    @if (Session::has('post.info'))
        <div class="alert alert-primary alert-dismissible fade show text-center" role="alert">
            <strong>{{ Session::pull('post.info') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1>GORO API</h1>
    <div class="accordion" id="accordionExample">
        {{-- GET /api/index --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/index</strong>
            </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
                    <h3>200 OK</h3>
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
        {{-- end GET /api/index --}}

        {{-- POST /api/index --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/index</strong>
            </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form action="{{ route('api.index') }}" method="POST">
                    @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="searchString['title']" name="searchString[title]" value="{{ Session::get('post.searchString')['title'] ?? '' }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="searchString['content']" name="searchString[content]" value="{{ Session::get('post.searchString')['content'] ?? '' }}">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="searchString['author']" name="searchString[author]" value="{{ Session::get('post.searchString')['author'] ?? '' }}">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Search API</button>
                                <button class="btn btn-secondary" type="button" onclick="clearSearch()">Clear</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                    <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
    "view": "/api/index",
    "data": [
        {
            "id": 34,
            "title": "Omnis dolor et accusantium repellat error ex sed.",
            "content": "Dicta fuga sed nulla autem repudiandae nam incidunt. Tempore minus sunt qui non. Quaerat ex minima perferendis recusandae. Earum officiis sint labore necessitatibus ut hic.",
            "author": "Lia Zboncak",
            "created_at": "2024-09-08T16:37:15.000000Z",
            "updated_at": "2024-09-08T16:37:15.000000Z"
        },
        {
            "id": 11,
            "title": "Commodi a est modi omnis asperiores rem beatae cupiditate.",
            "content": "Quis inventore aspernatur necessitatibus sunt ex enim. Harum aut rerum ut dolores ut architecto. Nesciunt molestiae aut aut cum. Illo soluta minus et deleniti.",
            "author": "Dr. Brandy Feil",
            "created_at": "2024-09-08T16:37:09.000000Z",
            "updated_at": "2024-09-08T16:37:09.000000Z"
        }
    ]
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
{{--  --}}

                </div>
            </div>
        </div>
        {{-- end POST /api/index --}}

        {{-- POST /api/register --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/register</strong>
            </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <h2>Parameters</h2>
                    <form id="register_form" method="POST">
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
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('register_form', '{{ route('register') }}')">Register</button>
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('register_form', '{{ route('api.register') }}')">Register API</button>
                            </div>
                        </div>
                    </form>
                    <h2>Responses</h2>
                    <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
  "message": "Username is valid and saved successfully!"
}
                            </code></pre>
                        </div>
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
        {{-- end /api/register --}}

        {{-- GET /api/edit --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/edit/{id}</strong>
            </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Author</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Edit API</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $posts->first()->id }}</td>
                                    <td>{{ $posts->first()->title }}</td>
                                    <td>{{ $posts->first()->content }}</td>
                                    <td>{{ $posts->first()->author }}</td>
                                    <td>
                                        <a href="{{ route('edit', ['id' => $posts->first()->id]) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('api.edit', ['id' => $posts->first()->id]) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit API
                                        </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                    <h2>Responses</h2>
                                        <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
  "view": "/api/edit20",
  "data": {
    "id": 20,
    "title": "Fugit iste officia quasi non necessitatibus.",
    "content": "Laudantium sit totam quod maxime praesentium. Autem laboriosam labore omnis facere impedit. Temporibus enim autem quisquam officiis sit amet.",
    "author": "Ottis Reilly",
    "created_at": "2024-08-02T21:07:26.000000Z",
    "updated_at": "2024-08-02T21:07:26.000000Z"
  }
}
                            </code></pre>
                        </div>
                    <h3>404 Not Found</h3>
                        <div id="error-container">
                            <pre><code>
{
  "redirect": "/api/index",
  "error": "This post does not exist"
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
{{--  --}}

                </div>
            </div>
        </div>
        {{-- end GET /api/edit/{id} --}}

        {{-- POST /api/update --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/update</strong>
            </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <div class="card-body">
                        <form id="update_form" method="POST">
                            @csrf
                            <input type="text" name="id" value="{{ $posts->first()->id }}" hidden>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-text-paragraph"></i>Title</span>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $posts->first()->title) }}" placeholder="Enter title">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-file-text"></i>Content</span>
                                    <input type="text" class="form-control" id="content" name="content" value="{{ old('content', $posts->first()->content) }}" placeholder="Enter content">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-circle"></i>Author</span>
                                    <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $posts->first()->author) }}" placeholder="Enter author name">
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit" onclick="setFormAction('update_form', '{{ route('update') }}')">
                                <i class="bi bi-save"></i> Update
                            </button>
                            <button class="btn btn-success" type="submit" onclick="setFormAction('update_form', '{{ route('api.update') }}')">
                                <i class="bi bi-save"></i> Update API
                            </button>
                        </form>
                    </div>
                    <h2>Responses</h2>
                    <h3>200 OK</h3>
                        <div id="error-container">
                            <pre><code>
{
  "redirect": "/api/edit/27",
  "message": "Post updated successfully"
}
                            </code></pre>
                        </div>
                    <h3>404 Not Found</h3>
                        <div id="error-container">
                            <pre><code>
{
  "redirect": "/api/index",
  "error": "This post does not exist"
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
        {{-- end POST /api/update --}}

        {{-- GET/api/delete/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse5">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/delete/{id}</strong>
            </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                    <h2>Parameters</h2>
                    <table class="table table-striped table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Author</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Delete API</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $posts->first()->id }}</td>
                                    <td>{{ $posts->first()->title }}</td>
                                    <td>{{ $posts->first()->content }}</td>
                                    <td>{{ $posts->first()->author }}</td>
                                    <td>
                                        <a href="{{ route('delete', ['id' => $posts->first()->id]) }}" class="btn btn-danger btn-sm">
                                            <i class="bi bi-pencil-square"></i> Delete
                                        </a>
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('api.delete', ['id' => $posts->first()->id]) }}" class="btn btn-danger btn-sm">
                                            <i class="bi bi-pencil-square"></i> Delete API
                                        </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
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
    function setFormAction(form_id, action) {
        const form = document.getElementById(form_id);
        form.action = action;
    }

    document.addEventListener('DOMContentLoaded', function () {
    var accordionExample = document.getElementById('accordionExample');
    var accordions = accordionExample.querySelectorAll('.accordion-button');

    accordions.forEach(function (button) {
        button.addEventListener('click', function () {
            var target = button.getAttribute('data-bs-target');
            localStorage.setItem('activeAccordion', target);
        });
    });

    var activeAccordion = localStorage.getItem('activeAccordion');
    if (activeAccordion) {
        var collapseElement = document.querySelector(activeAccordion);
        var bsCollapse = new bootstrap.Collapse(collapseElement, {
            toggle: true
        });
    }
});
    function clearSearch() {
        document.querySelectorAll('input[name="searchString[title]"], input[name="searchString[content]"], input[name="searchString[author]"]').forEach(input => {
            input.value = ''; // Clear input values of title, content, and author
        });
    }



</script>
