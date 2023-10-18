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
              <form action="{{route('workprocesses_update')}}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="id" value="{{$workprocesses->id}}" id="id" />
                <label>Werkprocess </label></br>
                <input type="text" name="werkprocess" id="werkprocess" value="{{$workprocesses->werkprocess}}" class="form-control" required></br>
                <div>
                <label>Kerntaak </label></br>
                  <select name="kerntaak" class="form-control">
                  @foreach($kerntaken as $kerntaak)
                    @if($kerntaak->id == $workprocesses->kerntaak_id)
                      <option value="{{$kerntaak->id}}" selected>{{ucwords($kerntaak->kerntaak)}}</option>
                    @else
                      <option value="{{$kerntaak->id}}" >{{ucwords($kerntaak->kerntaak)}}</option>
                    @endif
                  @endforeach
                  </select>
                </div>

                </br><label>Ticket </label></br>   
                @for($i=0;$i < count($tickets);$i++)
                    @if(($i + 1) % 4 == 0)
                      </div>
                    </div>
                    @endif
                    @if(($i + 1) % 4 == 0 || $i == 0)
                      <div class="row">
                        <div class="col-md-12">
                          <input type="checkbox" name="tickets[]" value="{{$tickets[$i]->id}}" {{in_array($tickets[$i]->id,$boundtickets) ? "checked" : ""}}/>
                          <label class="form-check-label">{{$tickets[$i]->opdracht}} {{$i}}</label></br>
                    @else
                          <input type="checkbox" name="tickets[]" value="{{$tickets[$i]->id}}" {{in_array($tickets[$i]->id,$boundtickets) ? "checked" : ""}}/>
                          <label class="form-check-label">{{$tickets[$i]->opdracht}} {{$i}}</label></br>
                    @endif

                    @if($i == count($tickets) - 1)
                      </div>
                    </div>
                    @endif
                @endfor
                </br><input type="submit" value="Update" class="btn btn-success"></br>
            </form>
          
          </div>
        </div>
    </div>
  </div>
</div>
@stop
