@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/ticket' => 'Note',
            '/manage/ticket/'.$ticket->id => $ticket->name,
            '/manage/ticket/'.$ticket->id.'/note/'.$ticket->id => $note->title,
        ],
    ])

    @component('components.panel',['title'=>'Update Note'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/ticket/'.$ticket->id.'/note/'.$note->id])
        @endslot
        {!! Former::open_vertical('/manage/ticket/'.$ticket->id.'/note/'.$note->id)->method('PATCH') !!}
        {!! Former::populate($note) !!}
        @include('manage.ticket.note.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
