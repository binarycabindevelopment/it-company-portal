@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/schedule/default' => 'Default Schedule',
            '/manage/schedule/default/event/'.$event->id.'/edit' => 'Edit '.$event->name
        ],
    ])

    @component('components.panel',['title'=>'Update Event'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/schedule/default/event/'.$event->id])
        @endslot
        {!! Former::open_vertical('/manage/schedule/default/event/'.$event->id)->method('PATCH') !!}
        {!! Former::populate($event) !!}
        @include('components.event.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
