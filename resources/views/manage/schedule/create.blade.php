@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/schedule' => 'Schedules',
            '/manage/schedule/create' => 'New Schedule',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical_for_files($baseRoute)->method('POST') !!}
        @include('manage.schedule.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
@section('scripts')
    @include('manage.schedule.partials.scripts')
@endsection
