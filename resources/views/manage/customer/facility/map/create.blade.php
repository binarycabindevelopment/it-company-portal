@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id => $facility->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id.'/map/create' => 'New Map',
        ],
    ])

    @component('components.panel',['title'=>'New Map For '.$facility->name])
        {!! Former::open_vertical_for_files('/manage/customer/'.$customer->id.'/facility/'.$facility->id.'/map')->method('POST') !!}

        @include('manage.customer.facility.map.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>

        {!! Former::close() !!}
    @endcomponent

@endsection
