@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Account'])
        <a href="{{ url('/account/user') }}">User</a>
    @endcomponent

@endsection
