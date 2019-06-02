@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Users'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-3">
                    {!! Former::text('global','') !!}
                </div>
                <div class="col col-2">
                    <button type="submit" class="btn btn-default btn-block">Search</button>
                </div>
            </div>
            {!! Former::close() !!}
        @endcomponent

        <hr/>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>@include('components.sort-button',['sortField'=>'created_at']) Date Created</th>
                <th>@include('components.sort-button',['sortField'=>'first_name']) First Name</th>
                <th>@include('components.sort-button',['sortField'=>'last_name']) Last Name</th>
                <th>@include('components.sort-button',['sortField'=>'email']) Email</th>
                <th>@include('components.sort-button',['sortField'=>'role']) Role</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->created_at->format('m/d/Y g:ia') }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{ url($baseRoute.'/'.$user->id.'/edit') }}" class="btn btn-info">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $users->appends($_GET)->render() !!}

    @endcomponent

@endsection
