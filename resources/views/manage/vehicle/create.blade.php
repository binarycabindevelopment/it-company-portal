@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/vehicle' => 'Vehicle',
            '/manage/vehicle/create' => 'Create',
        ],
    ])

    @component('components.panel',['title'=>'New '.$baseTitleSingular])
        {!! Former::open_vertical($baseRoute)->method('POST') !!}
        @include('manage.vehicle.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection