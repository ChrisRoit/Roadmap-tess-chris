@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">opleidingen Page</div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-12 m-bottom">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm">Back</a>
              </div>
            </div>
            <form action="{{route('degrees_update')}}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="id" id="id" value="{{$opleiding ->id}}" id="id" />
              <label>Naam </label></br>
              <input type="text" name="name" id="name" value="{{$opleiding ->name}}" class="form-control m-bottom" required></br>
              <label>Niveau</label>
              <select name="niveau" class="form-control m-bottom">
                @for($i=0;$i < 4;$i++)
                  @if((5 - ($i + 1)) == $opleiding->niveau )
                    <option value="{{5 - ($i + 1)}}" selected>{{5 - ($i + 1)}}</option>
                  @else
                    <option value="{{5 - ($i + 1)}}">{{5 - ($i + 1)}}</option>
                  @endif
                @endfor
              </select>
              <input type="submit" value="Update" class="btn btn-success m-bottom"></br>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
