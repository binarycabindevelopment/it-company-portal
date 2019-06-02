@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/credential' => 'Credential',
            url($credential->path()) => $credential->id,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$credential->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$credential->id)->method('PATCH') !!}
        {!! Former::populate($credential) !!}
        @include('manage.credential.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.credential.partials.scripts')
@endsection
