@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/map' => 'Map',
            '/manage/map/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New' ])
        {!! Former::open_vertical($baseRoute.$ticket->id.'/facility')->method('POST') !!}
         @include('account.customer.ticket.facility.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.map.partials.scripts')
@endsection
