@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-3 bg-light rounded-3">
    <div class="container py-5">
        <div class="logo_laravel">
            <img width="200px" src="{{ Vite::asset('resources/img/code-svgrepo-com.png') }}" alt="">
        </div>
        <h1 class="display-5 fw-bold">
            Welcome to My Back-Office
        </h1>

        <p class="col-md-8 fs-4">
            La Dashboard implementata dà la possibilità di visualizzare, modificare, aggiungere ed eliminare qualsiasi tipo di progetto oltre che personalizzarlo.
        </p>
    </div>
</div>
@endsection