@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/contact/'.$contact->id => $contact->name,
        ],
    ])

    @component('components.panel',['title'=>'Update Contact'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/customer/'.$customer->id.'/contact/'.$contact->id])
        @endslot
        {!! Former::open_vertical('/manage/customer/'.$customer->id.'/contact/'.$contact->id)->method('PATCH') !!}
        {!! Former::populate($contact) !!}
        @include('manage.customer.contact.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
