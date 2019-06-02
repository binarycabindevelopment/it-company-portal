@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$employee->id])
        @endslot
        {!! Former::open_vertical_for_files($baseRoute.'/'.$employee->id)->method('PATCH') !!}
        {!! Former::populate($employee) !!}
        @include('manage.employee.partials.fields',['update'=>true])
        @include('manage.employee.contact.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
