@extends('layouts.app')
@section('content')

<div class="content">
  <div class="container py-5">
    <h2 class="fw-bold fs-1 pb-2">Edit the project</h2>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" enctype="multipart/form-data">
      @csrf()
      @method('patch')
      
      <div class="mb-4">
        <label class="fw-bold" for="title">{{__('Title')}}</label>
        <input class="form-control" type="text" name="title" value="{{ $project->title }}" autofocus>
        {{-- @error('title')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->get('title')}}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="mb-4">
        <label class="fw-bold" for="link">{{__('Project link')}}</label>
        <input class="form-control" type="text" name="link" value="{{ $project->link }}">
        {{-- @error('link')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->get('link')}}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="mb-4">
        <label class="fw-bold" for="description">{{__('Description')}}</label>
        <textarea class="form-control" type="text" name="description">{{ $project->description }}</textarea>
        {{-- @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->get('description')}}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="mb-4">
        <label class="fw-bold" for="old-thumb">Current thumb image</label>
        <img src="{{ asset('storage/' . $project->thumb) }}" alt="" class="img-thumbnail d-block my-2" style="width:250px;" name="old-thumb">

        <label for="input-group" class="fw-bold">Thumb Image</label>
        <div class="input-group">
          <label class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">
            <input type="file" class="form-control d-none" name="thumb" accept="img/*">
            Choose an image on your machine
          </label>
          <input type="text" class="form-control" name="thumb_link" placeholder="...or provide an external image link">
        </div>
        {{-- @error('thumb')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->get('thumb')}}</strong>
        </span>
        @enderror --}}
      </div>
      <div class="mb-4">
        <div class="row">
          <div class="col-6">
            <label for="form-select" class="fw-bold">Project type</label>
            <select class="form-select" name="type_id">
              @foreach ($types as $singleType)
                <option value="{{ $singleType->id }}" {{ $project->type_id === $singleType->id ? 'selected' : '' }}>{{ $singleType->name }}</option>
              @endforeach
            </select>
            {{-- <label class="fw-bold" for="language">{{__("Select the project's language")}}</label>
            <select class="form-select" multiple name="language" >
              <option selected disabled hidden>Select a language</option>
              <option value="HTML">HTML</option>
              <option value="CSS">CSS</option>
              <option value="Bootstrap">Bootstrap</option>
              <option value="JavaScript">JavaScript</option>
              <option value="VueJS">VueJS</option>
              <option value="Vite">Vite</option>
              <option value="SCSS">SCSS</option>
              <option value="PHP">PHP</option>
              <option value="MySQL">MySQL</option>
              <option value="Laravel">Laravel</option>
            </select> --}}
            {{-- @error('language')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('language')}}</strong>
            </span>
            @enderror --}}
          </div>
          <div class="col-6">
            <label class="fw-bold" for="release">{{__('Release date')}}</label>
            <input class="form-control" type="date" name="release" value="{{ $project->release }}">
            {{-- @error('date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->get('date')}}</strong>
            </span>
            @enderror --}}
          </div>
        </div>
      </div>
      <div class="mb-4 pt-2">
        <button type="submit" class="btn btn-primary btn-lg">Post the project's edit!</button>
      </div>
    </form>

  </div>
</div>

@endsection