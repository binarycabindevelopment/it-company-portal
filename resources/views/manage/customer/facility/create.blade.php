@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/facility/create' => 'New Facility',
        ],
    ])

    @component('components.panel',['title'=>'New Facility For '.$customer->name])
        {!! Former::open_vertical_for_files('/manage/customer/'.$customer->id.'/facility')->method('POST') !!}
        @include('manage.customer.facility.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
