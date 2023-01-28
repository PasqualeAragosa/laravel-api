@extends('layouts.admin')

@section('content')

<div class="top_content d-flex">
    <h1 class="py-3">Create new Project</h1>

</div>

@include('partials.errors')
<form action="{{route('admin.projects.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('title') }}">
        <small id="helpId" class="text-muted">Insert title, max 100 characters, required field</small>
    </div>
    @error('title')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('slug') }}">
        <small id="helpId" class="text-muted">Required field</small>
    </div>
    @error('slug')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="cover_image" class="form-label">Add cover image</label>
        <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="" aria-describedby="helpId">
    </div>
    @error('cover_image')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="type_id" class="form-label">Type</label>
        <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
            <option value="" selected>Select Type</option>
            @foreach($types as $type)
            <option value="{{$type->id}}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{$type->name}}</option>
            @endforeach
        </select>
    </div>
    @error('type_id')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="technologies" class="form-label">Technologies</label>
        <select multiple class="form-select form-select-lg" name="technologies[]" id="technologies">
            <option value="" disabled>Select one or more technologies</option>
            @forelse($technologies as $technology)
            @if($errors->any())
            <option value="{{$technology->id}}" {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{$technology->name}}
            </option>
            @else
            <option value="{{$technology->id}}">{{$technology->name}}</option>
            @endif
            @empty
            <option value="" disabled>No technology to select yet. Create one or more.</option>
            @endforelse
        </select>
    </div>
    @error('technologies')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="descripbodytion" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" placeholder="" aria-describedby="helpId">{{ old('body') }}</textarea>
    </div>
    @error('body')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <button class="btn btn-primary" type="submit">Add Project</button>

</form>
@endsection