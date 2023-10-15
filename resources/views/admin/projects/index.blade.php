@extends('layouts.app')
@section('content')

<div class="content">
  <div class="container p-5 mb-4">
    <div class="row g-3">
      @foreach ($projects as $project)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <a class="text-decoration-none text-white h-100 w-100" href="{{ route("admin.projects.show", $project->slug) }}">
            <div class="card bg-transparent overflow-hidden h-100 position-relative">
              <div class="card-content-box h-100">
                <img src="{{ asset('storage/' . $project->thumb)}}" class="card-img-top border-0 rounded-0" alt="" title="">
                <div class="card-body posionated-box text-white position-absolute d-flex flex-column justify-content-center align-items-center h-100">
                  <p class="card-text text-uppercase fw-bold fs-5 text-center">{{ $project->title}}</p>
                  <div class="d-flex ">
                    <a href="{{ route("admin.projects.edit", $project->slug) }}" class="text-decoration-none"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                    <form action="{{ route("admin.projects.destroy", $project->slug)}}" method="POST">
                      @csrf()
                      @method("DELETE")
                      <button type="submit" class="btn btn-danger btn-sm ms-2">Delete</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>

@endsection