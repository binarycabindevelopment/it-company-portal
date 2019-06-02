{{ dd($event) }}
@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Schedules'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-3">
                    {!! Former::text('global','') !!}
                </div>
                <div class="col col-2">
                    <button type="submit" class="btn btn-default btn-block">Search</button>
                </div>
            </div>
            {!! Former::close() !!}
        @endcomponent

        <hr/>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>@include('components.sort-button',['sortField'=>'event_start_at']) Start At </th>
                <th>@include('components.sort-button',['sortField'=>'event_end_at']) End At</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Repeat</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>@if($event->event_start_at) {{ $events->event_start_at->format('m/d/Y') }} @endif</td>
                        <td>@if($event->event_end_at){{ $events->event_end_at->format('m/d/Y') }} @endif</td>
                        <td>@if($event->name) {{ $events->name }} @endif</td>
                        <td><a href="{{ url($event->path()) }}" class="btn btn-info">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    @endcomponent

@endsection
