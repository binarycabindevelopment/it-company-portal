@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee/'.$employee->id.'/schedule/' => 'Employee Schedule',
            '/manage/employee/default/event/create' => 'New Event',
        ],
    ])

    @component('components.panel',['title'=>'New Event'])
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/schedule/event')->method('POST') !!}
        @include('components.event.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
