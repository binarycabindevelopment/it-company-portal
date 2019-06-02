@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Asset',
            '/manage/asset/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical($baseRoute)->method('POST') !!}
        @include('manage.asset.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.asset.partials.scripts')
@endsection