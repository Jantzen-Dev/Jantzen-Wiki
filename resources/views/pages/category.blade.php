@extends('partial.base')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Authors table</h6>
              <a href="/add-wiki/{{$wikiId}}" class="btn btn-primary">
                + Add Wiki
              </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-3">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th >Title</th>
                      <th >Category</th>
                      <th >Created At</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($wikis as $wiki)
                    <tr>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$wiki->title}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$wiki->category->name}}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{$wiki->created_at}}</p>
                      </td>
                      <td class="align-middle">
                        <a href="/wiki-page/{{$wiki->id}}" class="btn btn-primary bg-gradient-primary">View</a>
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
@endsection