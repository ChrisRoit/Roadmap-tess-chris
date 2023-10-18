@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">Kerntaak Page</div>
        <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
          </div>
        </div>
            <form action="{{route('update-kerntaak')}}" method="POST">
              {!! csrf_field() !!}
              <input type="hidden" name="id" id="id" value="{{$kerntaak->id}}" id="id" />
              <label>Kerntaak</label></br>
              <input type="text" name="kerntaak" id="kerntaak" value="{{$kerntaak->kerntaak}}" class="form-control m-bottom"></br>
              <label>Code </label></br>
              <input type="text" name="code" id="code" value="{{$kerntaak ->code}}" class="form-control m-bottom"></br>
              <div>
                <label>Opleiding</label>
                <select name="degrees" class="form-control m-bottom">
                  @foreach($degrees as $degree)
                  @if($degree->id == $kerntaak->opleiding_id)
                    <option value="{{$degree->id}}" selected>{{$degree->name}}</option>
                  @else
                    <option value="{{$degree->id}}" >{{$degree->name}}</option>
                  @endif
                  @endforeach
                </select>   
              </div>

              <input type="submit" value="Update" class="btn btn-success m-bottom"></br>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
