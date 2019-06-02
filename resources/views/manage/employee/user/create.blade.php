@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Employee',
            '/manage/asset/'.$employee->id => $employee->id,
            '/manage/asset/'.$employee->id.'/contact/create' => 'Linked  User',
        ],
    ])

    @component('components.panel',['title'=>'Linked User To '.$employee->id])
        {!! Former::open_vertical('/manage/employee/'.$employee->id.'/user')->method('POST') !!}

        @component('components.panel',['title'=>'Link User'])
            @include('manage.employee.user.partials.fields',['update'=>false])
            <button type="submit" class="btn btn-primary">Save</button>
        @endcomponent

        {!! Former::close() !!}
    @endcomponent

@endsection
