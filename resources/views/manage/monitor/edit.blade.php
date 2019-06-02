@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/monitor' => 'Monitor',
            url($monitor->path()) => $monitor->id,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$monitor->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$monitor->id)->method('PATCH') !!}
        {!! Former::populate($monitor) !!}
        @include('manage.monitor.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.monitor.partials.scripts')
@endsection
