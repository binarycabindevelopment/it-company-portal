@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$customer->id])
        @endslot
        {!! Former::open_vertical_for_files($baseRoute.'/'.$customer->id)->method('PATCH') !!}
        {!! Former::populate($customer) !!}
        @include('manage.customer.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
