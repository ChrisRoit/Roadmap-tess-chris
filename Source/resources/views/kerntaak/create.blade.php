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
                  <form action="{{ route('kerntaken_store')}}" method="post">
                    {!! csrf_field() !!}
                    <label>Kerntaak</label></br>
                    <input type="text" name="kerntaak" id="kerntaak" class="form-control"></br>
                    <label>Code </label></br>
                    <input type="text" name="code" id="code" class="form-control"></br>
                    <div>
                      <label>Opleiding</label>
                      <select name="degrees" class="form-control m-bottom">
                        @foreach($degrees as $degree)
                          <option value="{{$degree->id}}">{{$degree->name}}</option>
                        @endforeach
                      </select>   
                    </div>
                    <input type="submit" value="Save" class="btn btn-success m-bottom"></br>
                </form>
              </div>
            </div>
          </div>
      </div>
</div>
@endsection
