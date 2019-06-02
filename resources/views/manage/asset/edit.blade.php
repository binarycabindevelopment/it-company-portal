@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Asset',
            url($asset->path()) => $asset->name,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$asset->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$asset->id)->method('PATCH') !!}
        {!! Former::populate($asset) !!}
        @include('manage.asset.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.asset.partials.scripts')
@endsection
