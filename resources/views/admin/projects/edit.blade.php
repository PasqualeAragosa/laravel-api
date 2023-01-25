@extends('layouts.admin')

@section('content')

<div class="top_content d-flex">
    <h1 class="py-3">Edit Project {{($project->title)}}</h1>

</div>

@include('partials.errors')
<form action="{{route('admin.projects.update', $project->slug)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class=" mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('title', $project->title) }}">
        <small id="helpId" class="text-muted">Insert title, max 100 characters, required field</small>
    </div>
    @error('title')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{ old('slug', $project->slug) }}">
        <small id="helpId" class="text-muted">Required field</small>
    </div>
    @error('slug')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3 d-flex align-items-end gap-3">
        <div>
            <label for="cover_image" class="form-label d-block">Edit cover image</label>
            <img class="edit_form_img" src="{{asset('storage/' . $project->cover_image)}}" alt="">
        </div>

        <div>
            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror" placeholder="" aria-describedby="helpId">
            <small id="helpId" class="text-muted">Edit cover image</small>
        </div>
    </div>
    @error('cover_image')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="type_id" class="form-label">Type</label>
        <select class="form-select form-select-lg @error('type_id') 'is-invalid' @enderror" name="type_id" id="type_id">
            <option value="" selected>Select Type</option>
            @forelse($types as $type)
            <option value="{{$type->id}}" {{ old('type_id') == $type->id ? '$project->type->id' : '' }}>{{$type->name}}</option>
            @empty
            <option value="">😔 Sorry no type to show</option>
            @endforelse
        </select>
    </div>
    @error('type_id')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" placeholder="" aria-describedby="helpId">{{ old('body', $project->body) }}</textarea>
    </div>
    @error('body')
    <div class="alert alert-danger">{{$message}}</div>
    @enderror

    <button class="btn btn-primary" type="submit">Edit Project</button>

</form>
@endsection