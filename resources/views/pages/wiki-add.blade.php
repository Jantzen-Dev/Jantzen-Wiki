@extends('partial.base')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Add Wiki</h5>
    
                  <!-- Quill Editor Full -->
                  <button class="btn btn-success bg-gradient-success" id="save-button">Save</button><br>
                  <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" id="title" class="form-control">
                  </div><br>
                  <div class="mb-3">
                    <label class="form-label">Category ID</label>
                    <input type="text" id="category" class="form-control" value="{{$wikiId}}" readonly>
                  </div><br>

                  <label class="form-label">Content</label>
                  <div id="quill-editor" class="quill-editor-full">
                   
                  </div>
                  <!-- End Quill Editor Full -->
    
                </div>
            </div>
        </div>
    </div>
  </div>
  <script>
    document.getElementById('save-button').addEventListener('click', function() {
        var title = document.getElementById('title').value;
        var category_id = document.getElementById('category').value;
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
        var contents = quill.root.innerHTML;

        fetch('{{ route('wiki.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                title: title,
                category_id: category_id,
                contents: contents
            })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.href = data.redirect_url;
            }
        });
    });
</script>
@endsection