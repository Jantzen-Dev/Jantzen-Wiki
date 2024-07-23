@extends('partial.base')

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">{{$wiki->title}}</h5>
    
                  
                  
                  <div class="mt-6">
                   {!! $wiki->contents !!}
                  </div><br>

                 
    
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection