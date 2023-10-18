@extends('layouts.app')


@section("content")
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Roadmap van {{ucwords($roadmap->user->name)}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL::previous()}}" class="btn btn-sm btn-primary m-bottom">Back</a>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Opleiding</h4>
                            <p>Niveau {{$roadmap->degree->niveau}} - {{ucwords($roadmap->degree->name)}}</p>
                            <hr style="color:grey">
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Kerntaken</h4>    
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Kerntaak</td>
                                        <td>code</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roadmap->degree->kerntaken as $kerntaak)
                                    <tr>
                                        <td>{{ucwords($kerntaak->kerntaak)}}</td>
                                        <td>{{$kerntaak->code}}</td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Werkprocessen</h4>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Werkproces</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roadmap->degree->kerntaken as $kerntaak)
                                        @foreach($kerntaak->workprocesses as $workprocess)
                                        <tr>
                                            <td>{{ucwords($workprocess->werkprocess)}}</td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Tickets</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>Opdracht</td>
                                        <td>Week</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roadmap->degree->kerntaken as $kerntaak)
                                        @foreach($kerntaak->workprocesses as $workprocess)
                                            @foreach($workprocess->tickets as $ticket)
                                            
                                            @if($weeknumber >= $ticket->lesweek)
                                            <tr>
                                                <td>{{ucwords($ticket->opdracht)}}</td>
                                                <td>{{$ticket->lesweek}}</td>
                                                <td>
                                                    <a href="{{route('ticket_show',['id' => $ticket->id])}}" class="btn btn-sm btn-primary">View</a>
                                                </td>
                                            </tr>
                                           
                                      
                                            @endif
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection