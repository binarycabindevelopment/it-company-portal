@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/ticket' => 'Tickets',
            '/manage/ticket/'.$ticket->id => $ticket->name,
            '' => 'New Ticket',
        ],
    ])

    @component('components.panel',['title'=>'New Note For '.$ticket->title])
        {!! Former::open_vertical('/manage/ticket/'.$ticket->id.'/employee')->method('POST') !!}
        @include('manage.ticket.employee.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
