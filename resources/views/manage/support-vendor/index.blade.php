@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Support Vendors'])
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
                <th>@include('components.sort-button',['sortField'=>'name']) Name</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                @foreach($supportVendors as $supportVendor)
                    <tr>
                        <td>{{ $supportVendor->name }}</td>
                        <td><a href="{{ url($baseRoute.'/'.$supportVendor->id.'/edit') }}" class="btn btn-info">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $supportVendors->appends($_GET)->render() !!}

    @endcomponent

@endsection
