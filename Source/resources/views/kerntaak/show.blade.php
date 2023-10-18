@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">Kerntaak Page</div>
        <div class="card-body">
            <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
            <h5 class="card-title">Kerntaak : {{ $kerntaak->kerntaak }}</h5>
            <p class="card-text">Code : {{ $kerntaak->code }}</p>
            <p>Opleiding naam: {{ucwords($kerntaak->opleiding->name)}}</p>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection