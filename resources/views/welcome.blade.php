@extends('common.layout')
@section('content')



    <div class="accordion" id="accordionExample">
        {{-- /api/addpost --}}
        <div class="accordion-item">
            @if ($errors->any())
        @foreach ($errors->all() as $error)
            <strong>※{{ $error }}</strong> <br>
        @endforeach
        @endif

        @if (Session::has('newPost'))
            <p>{{ Session::pull('newPost') }}</p>
        @endif
            <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <div class="btn btn-success">POST</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/addpost</strong>
            </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
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
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('{{ route('addposts') }}')">Submit</button>
                                <button type="submit" class="btn btn-primary" onclick="setFormAction('{{ route('api.addpost') }}')">Submit API</button>
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
{{--  --}}

                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <div class="btn btn-primary">GET</div>
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;/api/addpost</strong>
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
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
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Accordion Item #3
            </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
            </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function setFormAction(action) {
        const form = document.getElementById('myForm');
        form.action = action;
    }
</script>
