@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/support-vendor' => 'Support Vendor',
            '/manage/support-vendor/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical($baseRoute)->method('POST') !!}
        @include('manage.support-vendor.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
