@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">opleiding Page</div>
        <div class="card-body">
            <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
            <p class="card-text">Naam : {{ $degrees->name }}</p>
            <p class="card-text">Niveau: {{$degrees->niveau}}</p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection