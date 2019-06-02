@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/pay-rate' => 'Pay Rates',
            '/manage/employee/'.$employee->id.'/pay-rate/create' => 'New',
        ],
    ])

    @component('components.panel',['title'=>'New Pay Rate'])
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/pay-rate')->method('POST') !!}
        @include('manage.employee.pay-rate.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
