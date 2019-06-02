@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '' => 'New Contact',
        ],
    ])

    @component('components.panel',['title'=>'New Contact For '.$customer->name])
        {!! Former::open_vertical('/manage/customer/'.$customer->id.'/contact')->method('POST') !!}
        @include('manage.customer.contact.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
