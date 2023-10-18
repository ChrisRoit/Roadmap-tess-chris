@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">Tickets</div>
                    <div class="card-body">
                    <a href="{{URL::previous()}}" class="btn btn-primary btn-sm">Back</a>
                        @if(Auth::user()->is_admin || Auth::user()->is_operator)
                        <a href="{{ url('/tickets/create') }}" class="btn btn-success btn-sm" title="Add New kerntaak">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        @endif
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Opdracht</th>
                                        <th>Lesweek</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($ticket as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->opdracht }}</td>
                                        <td>{{ $item->lesweek }}</td>
                                        
                                        <td>
                                            <a href="{{ route('ticket_show',['id' => $item->id]) }}" title="View kerntaak"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            @if(Auth::user()->is_admin || Auth::user()->is_operator)
                                            <a href="{{ url('/tickets/' . $item->id . '/edit') }}" title="Edit kerntaak"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
                                                Verwijder
                                            </button>
                                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        Weet je het zeker dat je de ticket wilt verwijderen?
                                                    </div>
                                                    <div class="modal-footer">
                                                    <a href="{{ url('/tickets/' . $item->id . '/destroy') }}" title="delete kerntaak"><button class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>Ja</button></a>
                                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Nee</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$ticket->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
