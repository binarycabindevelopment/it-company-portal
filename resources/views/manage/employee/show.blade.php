<?php
$title = $employee->name;
if (!empty($employee->key)) {
    $title .= ' (' . $employee->key . ')';
}
?>
@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
        ],
    ])

    @include('manage.employee.partials.subnav')

    @component('components.panel',['title'=>$title])
        @slot('action')
            <a href="{{ url($employee->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            @if($employee->contact)
                <div class="col-lg-7">
                    <p><strong>Employee Key: </strong>{{ $employee->key }}</p>
                    @include('components.contact.contact-panel',['contact'=>$employee->contact])
                </div>
            @endif
            <div class="col-lg-5">
                @component('components.user.user-panel',['basePath'=>$employee->path('/user'),'user'=>$employee->user])
                @endcomponent
            </div>
        </div>

    @endcomponent


@endsection
