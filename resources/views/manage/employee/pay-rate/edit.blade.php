@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/pay-rate' => 'Pay Rates',
            '/manage/employee/'.$employee->id.'/pay-rate/'.$payRate->id.'/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update Pay Rate'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/employee/'.$employee->id.'/pay-rate/'.$payRate->id])
        @endslot
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/pay-rate/'.$payRate->id)->method('PATCH') !!}
        {!! Former::populate($payRate) !!}
        @include('manage.employee.pay-rate.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
