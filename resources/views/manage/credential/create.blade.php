@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/credential' => 'Credential',
            '/manage/credential/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical($baseRoute)->method('POST') !!}
        @include('manage.credential.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.credential.partials.scripts')
@endsection