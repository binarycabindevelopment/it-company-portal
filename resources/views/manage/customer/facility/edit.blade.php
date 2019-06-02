@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id => $facility->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id.'/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update Facility'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/customer/'.$customer->id.'/facility/'.$facility->id])
        @endslot
        {!! Former::open_vertical_for_files('/manage/customer/'.$customer->id.'/facility/'.$facility->id)->method('PATCH') !!}
        {!! Former::populate($facility) !!}
        @include('manage.customer.facility.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
