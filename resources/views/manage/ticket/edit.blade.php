@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/ticket' => 'Tickets',
            '/manage/ticket/'.$ticket->id => $ticket->title,
            '/manage/ticket/'.$ticket->id.'/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$ticket->id])
        @endslot
        {!! Former::open_vertical_for_files($baseRoute.'/'.$ticket->id)->method('PATCH') !!}
        {!! Former::populate($ticket) !!}
        @include('manage.ticket.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
