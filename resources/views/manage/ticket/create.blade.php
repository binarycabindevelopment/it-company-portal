@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/ticket' => 'Tickets',
            '/manage/ticket/create' => 'New Ticket',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical_for_files($baseRoute)->method('POST') !!}
        @include('manage.ticket.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
@section('scripts')
    @include('manage.ticket.partials.scripts')
@endsection
