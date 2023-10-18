@extends("layouts.app")


@section("content")
    <users-overview 
        :users-data-route="'{{route('users_data')}}'" 
        :store-route="'{{route('users_store')}}'" 
        :update-route="'{{route('users_update')}}'"
        :delete-route="'{{route('users_delete')}}'"
        :token="'{{csrf_token()}}'"/>
@endsection