@extends('layouts.app')


@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Roadmaps
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-primary m-bottom">Back</a>
                            <a href="{{route('roadmaps_create')}}" class="btn btn-sm btn-success m-bottom">Create</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>User</td>
                                        <td>Opleiding</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roadmaps as $roadmap)
                                        <tr>
                                            <td>{{ucwords($roadmap->user->name)}}</td>
                                            <td>{{ucwords($roadmap->degree->name)}}</td>
                                            <td>
                                            <a href="{{ route('roadmaps_show',['id' => $roadmap->id]) }}" title="View werkprocess"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ route('roadmaps_edit',['id' => $roadmap->id]) }}" title="Edit werkprocess"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$roadmap->id}}">
                                                Verwijder
                                            </button>
                                            <div class="modal fade" id="exampleModal{{$roadmap->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        Weet je het zeker dat je de roadmap wilt verwijderen?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <a href="{{ route('roadmaps_delete',['id' => $roadmap->id]) }}" title="delete kerntaak"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Ja</button></a>
                                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Nee</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$roadmaps->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection