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
            <form action="{{route('update-ticket')}}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="id" id="id" value="{{$ticket->id}}" id="id" />
              <label>Opdracht </label></br>
              <textarea id="opdracht" name="opdracht" rows="4" cols="50" class="form-control" required>{{$ticket->opdracht}}</textarea><br>

              <label>Lesweek </label></br>
              <input type="text" name="lesweek" id="lesweek" value="{{$ticket->lesweek}}" class="form-control" required></br>

              <label>SBU minuten </label></br>
              <input type="text" name="sbu_minuten" id="sbu_minuten" value="{{$ticket->sbu_minuten}}" class="form-control" required></br>

              <label>BOT minuten </label></br>
              <input type="text" name="bot_minuten" id="bot_minuten" value="{{$ticket->bot_minuten}}" class="form-control" required></br>

              <label>Vaardigheid </label></br>
              <textarea id="vaardigheid" name="vaardigheid" rows="4" cols="50" class="form-control" required>{{$ticket->vaardigheid}}</textarea><br>
              
              <label>Kennis </label></br>
              <textarea id="kennis" name="kennis" rows="4" cols="50" class="form-control" required>{{$ticket->kennis}}</textarea><br>

              <label>Theorie </label></br>
              <textarea id="theorie" name="theorie" rows="4" cols="50" class="form-control" required>{{$ticket->theorie}}</textarea><br>
              
              <label>Labs </label></br>
              <input type="text" name="labs" id="labs" value="{{$ticket->labs}}" class="form-control" required></br>

              <label>Thema </label></br>
              <input type="text" name="thema" id="thema" value="{{$ticket->thema}}" class="form-control" required></br>

              <label>Werkprocess </label></br>
              @for($i=0;$i < count($workprocesses);$i++)
                  @if(($i + 1) % 4 == 0)
                    </div>
                  </div>
                  @endif
                  @if(($i + 1) % 4 == 0 || $i == 0)
                    <div class="row">
                      <div class="col-md-12">
                        <input type="checkbox" name="workprocesses[]" value="{{$workprocesses[$i]->id}}" {{in_array($workprocesses[$i]->id,$boundworkprocesses) ? "checked" : ""}}/>
                        <label class="form-check-label">{{$workprocesses[$i]->werkprocess}}</label></br>
                  @else
                  <input type="checkbox" name="workprocesses[]" value="{{$workprocesses[$i]->id}}" {{in_array($workprocesses[$i]->id,$boundworkprocesses) ? "checked" : ""}}/>
                        <label class="form-check-label">{{$workprocesses[$i]->werkprocess}}</label></br>
                  @endif

                  @if($i == count($workprocesses) - 1)
                    </div>
                  </div>
                  @endif
              @endfor
              </br>
              <input type="submit" value="Update" class="btn btn-success"></br>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
 