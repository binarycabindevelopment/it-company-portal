@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/contact/'.$contact->id => $contact->name,
        ],
    ])

    @component('components.panel',['title'=>'Update Contact'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/employee/'.$employee->id.'/contact/'.$contact->id])
        @endslot
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/contact/'.$contact->id)->method('PATCH') !!}
        {!! Former::populate($contact) !!}
        @include('manage.employee.contact.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
