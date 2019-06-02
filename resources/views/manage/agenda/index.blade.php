@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Agenda'])
        @slot('action')
            <a href="#" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Schedule New Ticket</a>
        @endslot

        <agenda :initial-employees="{{ \App\Employee::all() }}"></agenda>

    @endcomponent

@endsection
