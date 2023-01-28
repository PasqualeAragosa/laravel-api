@extends('layouts.admin')

@section('content')
<div class="content d-flex flex-column">

    <h1 class="py-3">Project {{$project->title}}</h1>

    <div class="bottom_content">
        @if($project->cover_image)
        <img width="200px" class="img-fluid mb-5" src="{{asset('storage/' . $project->cover_image)}}" alt="">
        @endif
        <h4>Title: </h4>
        <p>{{$project->title}}</p>
        <h4>Slug: </h4>
        <p>{{$project->slug}}</p>
        <h4>Type: </h4>
        <p>{{$project->type ? $project->type->name : 'No Type'}}</p>
        <h4>Technologies: </h4>
        @if(count($project->technologies) > 0)
        <!-- per ogni tecnologia assegnata mostro in nome -->
        @foreach($project->technologies as $technology)
        <p>{{$technology->name}}</p>
        @endforeach

        @else
        <p>No technology assigned for this project</p>
        @endif
        <h4>Body: </h4>
        <p>{{$project->body}}</p>
    </div>

    <a class="btn btn-warning mt-5 ms-auto" href="{{route('admin.projects.edit', $project->slug)}}"><i class="fa-solid fa-pencil"></i> edit</a>

</div>

@endsection