@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/account/customer/ticket' => 'Tickets',
            '/account/customer/create' => 'New Ticket',
        ],
    ])

    @component('components.panel',['title'=>'New '])
        {!! Former::open_vertical_for_files('/account/customer/ticket/')->method('POST') !!}
        @include('account.customer.ticket.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
@section('scripts')
    @include('account.customer.ticket.partials.scripts')
@endsection
