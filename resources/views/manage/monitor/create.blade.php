@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/monitor' => 'Monitor',
            '/manage/monitor/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical($baseRoute)->method('POST') !!}
        @include('manage.monitor.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.monitor.partials.scripts')
@endsection