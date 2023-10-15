@extends('layouts.app')
@section('content')
  <div class="content">
    <div class="container p-5 mb-4">
      <div class="row d-flex justify-content-center">
        <div class="col-6">
          <a class="text-decoration-none text-black">
            <div class="card bg-transparent overflow-hidden h-100 position-relative">
              <div class="card-content-box">
                <img src="{{ asset('storage/' . $project?->thumb) }}" class="card-img-top border-0 rounded-0" alt="" title="">
                <div class="card-body">
                  <h5 class="card-title fw-bold fs-2">{{ $project?->title }}</h5>
                  <p class="fw-bold mt-2 mb-0">Description:</p>
                  <p class="card-text">{{ $project?->description }}</p>
                  <p class="card-text mb-0"><span class="fw-bold">Release date:</span> {{ $project?->release }}</p>
                  <p class="card-text"><span class="fw-bold">Language:</span> {{ $project?->language }}</p>
                  <p class="card-text"><span class="fw-bold">Repository link:</span> <a href="{{ $project?->link }}">{{ $project?->link }}</a></p>
                </div>              
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection