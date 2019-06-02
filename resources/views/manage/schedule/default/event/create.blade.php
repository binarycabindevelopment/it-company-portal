@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/schedule/default' => 'Default Schedule',
            '/manage/schedule/default/event/create' => 'New Event',
        ],
    ])

    @component('components.panel',['title'=>'New Event'])
        {!! Former::open_vertical('/manage/schedule/default/event')->method('POST') !!}
        @include('components.event.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
