@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome {{ucfirst($user->name)}}</div>

                <div class="card-body">
                    <div class="container home-content-title-margin">
                    @if($user->is_admin)
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Administratieve Opties</h3>
                                <hr />
                            </div>
                        </div>
                        <!-- content rows -->
                        <div class="home-content-row row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <a href="{{route('users')}}">
                                                <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                            </a>
                                        </div>
                                        <div class="home-content-title-margin">
                                            <a href="{{route('users')}}">
                                                <h5>User Management</h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end content rows -->
                    @endif
                    @if(Auth::user()->is_admin || Auth::user()->is_operator)
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Beheerdersopties</h3>
                            <hr />
                        </div>
                    </div>
                    <!-- content rows -->

                    <!-- start content row 1 -->
                    <div class="home-content-row row">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('workprocesses')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('workprocesses')}}">
                                            <h5>Werkprocessen</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('kerntaken')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('kerntaken')}}">
                                            <h5>Kerntaken</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('degrees')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('degrees')}}">
                                            <h5>Opleidingen</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- end content row 1 -->

                    <!-- start content row 2 -->
                    <div class="home-content-row row">

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('ticket')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('ticket')}}">
                                            <h5>Ticket</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('roadmaps')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('roadmaps')}}">
                                            <h5>Roadmap Management</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end content row 2 -->

                    <!-- end content rows -->
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Gebruikersopties</h3>
                            <hr />
                        </div>
                    </div>
                    <!-- content rows -->
                    <div class="home-content-row row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('ticket')}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('ticket')}}">
                                            <h5>Tickets</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset(Auth::user()->roadmap))
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <a href="{{route('roadmaps_show',['id' => Auth::user()->roadmap->id])}}">
                                            <img class="img-fluid" src="{{asset('storage/office.jpg')}}" />
                                        </a>
                                    </div>
                                    <div class="home-content-title-margin">
                                        <a href="{{route('roadmaps_show',['id' => Auth::user()->roadmap->id ])}}">
                                            <h5>Jouw Roadmap</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <!-- end content rows -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
