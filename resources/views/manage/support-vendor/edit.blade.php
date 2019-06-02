@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/support-vendor' => 'Support Vendor',
            '/manage/support-vendor/'.$supportVendor->id.'/edit' => $supportVendor->name,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$supportVendor->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$supportVendor->id)->method('PATCH') !!}
        {!! Former::populate($supportVendor) !!}
        @include('manage.support-vendor.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
