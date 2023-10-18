@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">Tickets Page</div>
          <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
            </div>
          </div>
                <h5 class="card-title">Opdracht : {{ $ticket->opdracht }}</h5>
                <p class="card-text">Lesweek : {{ $ticket->lesweek }}</p>
                <p class="card-text">SBU minuten : {{ $ticket->sbu_minuten }}</p>
                <p class="card-text">BOT minuten : {{ $ticket->bot_minuten }}</p>
                <p class="card-text">Niveau : {{ $ticket->nivo }}</p>
                <p class="card-text">Vaardigheid : {{ $ticket->vaardigheid }}</p>
                <p class="card-text">Kennis : {{ $ticket->kennis }}</p>
                <p class="card-text">Theorie : {{ $ticket->theorie }}</p>
                <p class="card-text">Labs : {{ $ticket->labs}}</p>
                <p class="card-text">Thema : {{ $ticket->thema }}</p>
                <h5>Werkprocessen</h5>
                <hr />
                @foreach($ticket->workprocesses as $workprocess)
                  <p>{{$workprocess->werkprocess}}</p>
                @endforeach
            
          </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
