@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/schedule' => 'Schedule',
            '/manage/employee/'.$employee->id.'/schedule/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '])
        @slot('action')
            @include('components.delete-button',['url'=>'/manage/employee/'.$employee->id.'/schedule/'.$schedule->id])
        @endslot
        {!! Former::open_vertical_for_files('/manage/employee/'.$employee->id.'/schedule/'.$schedule->id)->method('PATCH') !!}
        {!! Former::populate($schedule) !!}
        @include('manage.employee.schedule.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

