@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/map' => 'Map',
            $map->path() => $map->name,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$map->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$map->id)->method('PATCH') !!}
        {!! Former::populate($map) !!}
        @include('manage.map.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.map.partials.scripts')
@endsection
