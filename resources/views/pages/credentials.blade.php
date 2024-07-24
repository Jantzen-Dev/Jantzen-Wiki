@extends('partial.base')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Credentials</h6>
              <!-- Vertically centered Modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered">
              + Add Credentials
            </button>
            <div class="modal fade" id="verticalycentered" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Add Credential</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <!-- Vertical Form -->
                    <form class="row g-3">
                      @csrf
                      <div class="col-12">
                        <label for="inputNanme4" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title">
                      </div>
                      <div class="col-12 mb-8">
                        <label for="inputNanme4" class="form-label">Content</label>
                        <div id="quill-editor" class="quill-editor-full">
                   
                        </div>
                      </div>
                    </form>
                    <!-- Vertical Form -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="save-button" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div><!-- End Vertically centered Modal-->
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-4">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Title</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($credentials as $item)
                    <tr>
                      <td >
                        <span class="text-secondary text-xs font-weight-bold">{{$item->title}}</span>
                      </td>
                      <td >
                        <span class="text-secondary text-xs font-weight-bold">{{$item->created_at}}</span>
                      </td>
                      <td class="align-middle">
                       <!-- Vertically centered Modal -->
                          <button type="button" class="btn btn-primary bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#cred-{{$item->id}}">
                            View
                          </button>
                          <div class="modal fade" id="cred-{{$item->id}}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">{{$item->title}}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  {!! $item->content !!}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div><!-- End Vertically centered Modal-->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  <script>
    document.getElementById('save-button').addEventListener('click', function() {
        var title = document.getElementById('title').value;
        var quill = new Quill('#quill-editor', {
            theme: 'snow'
        });
        var contents = quill.root.innerHTML;

        fetch('{{ route('credential.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                title: title,
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