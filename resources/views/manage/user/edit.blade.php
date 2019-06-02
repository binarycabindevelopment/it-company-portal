@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/user' => 'User',
            '/manage/user/'.$user->id.'/edit' => $user->email,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$user->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$user->id)->method('PATCH') !!}
        {!! Former::populate($user) !!}
        @include('manage.user.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
