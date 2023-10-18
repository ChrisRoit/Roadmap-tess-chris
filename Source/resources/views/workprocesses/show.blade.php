@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">Werkprocess Page</div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
              </div>
            </div>
                  <p class="card-text">Werkprocess : {{ ucwords($workprocess->werkprocess) }}</p>
                  <p>Kerntaak: {{$workprocess->kerntaak->kerntaak}}</p>
                  <p>Opleiding: {{$workprocess->kerntaak->opleiding->name}}</p>
                  <h5>Tickets</h5>
                  <hr />
                  @foreach($workprocess->tickets as $ticket)
                    <p>Ticket ID: {{$ticket->id}}</p>
                  @endforeach
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

@endsection