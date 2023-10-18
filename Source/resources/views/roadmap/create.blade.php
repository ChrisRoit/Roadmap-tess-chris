@extends('layouts.app')


@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Create Roadmap
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-primary m-bottom">Back</a>
                        </div>
                    </div>
                    <form method="POST" action="{{route('roadmaps_store')}}">
                        <input name="_token" value="{{csrf_token()}}" hidden/>
                        <label>User</label>
                        <select name="user" class="form-control">
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->email}}</option>
                            @endforeach
                        </select>
                        <label>Opleiding</label>
                        <select name="degree" class="form-control m-bottom">
                            @foreach($degrees as $degree)
                                <option value="{{$degree->id}}">{{$degree->name}}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection