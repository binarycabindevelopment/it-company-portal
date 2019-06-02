@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/user/'.$user->id => $user->name,
        ],
    ])

    @component('components.panel',['title'=>'Update User'])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/employee/'.$employee->id.'/user/'.$user->id])
        @endslot
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/user/'.$user->id)->method('PATCH') !!}
        {!! Former::populate($user) !!}
        @include('manage.employee.user.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
