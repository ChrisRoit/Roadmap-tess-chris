@extends('layouts.app')


@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-primary m-bottom">Back</a>
                        </div>
                    </div>
                    <form method="POST" action="{{route('roadmaps_update')}}">
                        <input name="_token" value="{{csrf_token()}}" hidden/>
                        <input name="roadmap" value="{{$roadmap->id}}" hidden />
                        <label>User</label>
                        <select name="user" class="form-control">
                            @foreach($users as $user)
                                @if(isset($user->roadmap))
                                    @if($user->roadmap->user_id == $roadmap->user->id)
                                        <option value="{{$user->id}}" selected>{{ucwords($user->name)}}</option>
                                    @else
                                        <option value="{{$user->id}}">{{ucwords($user->name)}}</option>
                                    @endif
                                @else
                                <option value="{{$user->id}}">{{ucwords($user->name)}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label>Opleiding</label>
                        <select name="degree" class="form-control">
                            @foreach($degrees as $degree)
                                
                                @if($roadmap->degree->id == $degree->id)
                                    <option value="{{$degree->id}}" selected>{{ucwords($degree->name)}}</option>
                                @else
                                    <option value="{{$degree->id}}">{{ucwords($degree->name)}}</option>
                                @endif
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