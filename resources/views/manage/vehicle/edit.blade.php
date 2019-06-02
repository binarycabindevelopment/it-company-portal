@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/vehicle' => 'Vehicle',
            url($vehicle->path()) => $vehicle->model,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$vehicle->id])
        @endslot
        {!! Former::open_vertical($baseRoute.'/'.$vehicle->id)->method('PATCH') !!}
        {!! Former::populate($vehicle) !!}
        @include('manage.vehicle.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection