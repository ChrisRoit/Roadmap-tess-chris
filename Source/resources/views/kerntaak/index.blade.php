@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Kerntaken</div>
                    <div class="card-body">
                        <a href="{{URL::previous()}}" class="btn btn-primary btn-sm">Back</a>
                        <a href="{{ url('/kerntaken/create') }}" class="btn btn-success btn-sm" title="Add New kerntaak">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kerntaak</th>
                                        <th>Code</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($kerntaak as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->kerntaak }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            <a href="{{ url('/kerntaken/' . $item->id) }}" title="View kerntaak"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/kerntaken/' . $item->id . '/edit') }}" title="Edit kerntaak"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                                Verwijder
                                            </button>
                                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        Weet je het zeker dat je de kerntaak wilt verwijderen?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <a href="{{ url('/kerntaken/' . $item->id . '/destroy') }}" title="delete kerntaak"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Ja</button></a>
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
                            {{$kerntaak->links("pagination::bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection