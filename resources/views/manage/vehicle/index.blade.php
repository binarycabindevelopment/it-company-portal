@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Vehicle'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span
                        class="glyphicon glyphicon-plus"></span> Create</a>
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
                <th>&nbsp;</th>
                <th>@include('components.sort-button',['sortField'=>'make']) Make</th>
                <th>@include('components.sort-button',['sortField'=>'model'])Model</th>
                <th>@include('components.sort-button',['sortField'=>'year']) Year</th>
                <th>@include('components.sort-button',['sortField'=>'vin']) VIN</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>

            @foreach($vehicles as $vehicle)
                <tr>
                    <td><a href="{{ url($vehicle->path()) }}" class="btn btn-primary">View</a></td>
                    <td>{{ $vehicle->make }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->year }}</td>
                    <td>{{ $vehicle->vin }}</td>
                    <td>
                        <a href="{{ url($vehicle->path('/edit')) }}" class="btn btn-info btn-block">Edit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $vehicles->appends($_GET)->render() !!}

    @endcomponent

@endsection