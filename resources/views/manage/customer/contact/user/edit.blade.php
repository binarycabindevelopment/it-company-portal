@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'User',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/user/'.$user->id => $user->email,
        ],
    ])

    @component('components.panel',['title'=>'Update User'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/customer/'.$customer->id.'/contact/'.$contact->id.'/user/'.$user->id])
        @endslot
        {!! Former::open_vertical('/manage/customer/'.$customer->id.'/contact/'.$contact->id.'/user/'.$user->id)->method('PATCH') !!}
        {!! Former::populate($user) !!}
        @include('manage.customer.contact.user.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
