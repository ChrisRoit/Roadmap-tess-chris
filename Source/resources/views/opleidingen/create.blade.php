@extends("layouts.app")


@section("content")
<div class="container">
    <div class="row m-bottom">
        <div class="col-md-8 offset-md-2">
            
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <div>Opleiding Toevoegen</div>
            </div>
            <div class="card-body">
                <a href="{{URL::previous()}}" class="btn btn-primary btn-sm m-bottom">Back</a>
                <form method="POST" action="{{route('degrees_store')}}">
                    <input name="_token" value="{{csrf_token()}}" hidden/>
                    <label>Opleiding</label>
                    <input name="name" placeholder="Opleiding naam" class="form-control m-bottom" required/>
                    <label>Niveau</label>
                    <select name="niveau" class="form-control m-bottom">
                        @for($i=0;$i < 4; $i++)
                            <option value="{{5 - ($i + 1)}}">{{5 - ($i + 1)}}</option>
                        @endfor
                    </select>
                    <button type="submit" class="btn btn-success m-bottom">Voeg toe</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection