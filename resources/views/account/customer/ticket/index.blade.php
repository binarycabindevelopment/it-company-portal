@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Tickets'])
        @slot('action')
            <a href="{{ url('/account/customer/ticket/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-2">{!! Former::select('ticketable_id','')->options(\App\Options\Facility::get('--Facility--')) !!}</div>
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
                <th>&nbsp;</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Status</th>
                <th>@include('components.sort-button',['sortField'=>'type']) Type</th>
                <th>@include('components.sort-button',['sortField'=>'item']) Item</th>
                <th>@include('components.sort-button',['sortField'=>'source']) Source</th>
                <th>@include('components.sort-button',['sortField'=>'priority']) Priority</th>
                <th>@include('components.sort-button',['sortField'=>'completed_at']) Completed At</th>
                <th>@include('components.sort-button',['sortField'=>'created_at']) Created At</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tbody>

                @foreach($tickets as $ticket)
                    <tr>
                        <td><a href="{{ url('account/customer/ticket/'.$ticket->id) }}" class="btn btn-info">View</a></td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket->type }}</td>
                        <td>{{ $ticket->item }}</td>
                        <td>{{ $ticket->source }}</td>
                        <td>{{ $ticket->priority }}</td>
                        <td>@if($ticket->completed_at) {{ $ticket->completed_at->format('m/d/Y g:ia') }} @endif</td>
                        <td>{{ $ticket->created_at->format('m/d/Y g:ia') }}</td>
                        <td><a href="{{ url('account/customer/ticket/'.$ticket->id.'/edit') }}" class="btn btn-info btn-block">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

          {{$tickets->links() }}

    @endcomponent

@endsection
