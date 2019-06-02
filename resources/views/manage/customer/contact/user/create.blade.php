@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Contact',
            '/manage/customer/'.$customer->id => $contact->name,
            '/manage/customer/'.$customer->id.'/contact/create' => 'Linked  User',
        ],
    ])

    @component('components.panel',['title'=>'Linked User To '.$contact->id])
        {!! Former::open_vertical('/manage/customer/'.$customer->id.'/contact/'.$contact->id.'/user/')->method('POST') !!}

        @component('components.panel',['title'=>'Link User'])
            {!! Former::populate($contact) !!}
            @include('manage.customer.contact.user.partials.fields',['update'=>true])

            <button type="submit" class="btn btn-primary">Save</button>
        @endcomponent

        {!! Former::close() !!}
    @endcomponent

@endsection
