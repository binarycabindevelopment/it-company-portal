@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Customers'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
             {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                
                <div class="col col-2">{!! Former::select('customer_id','')->options(\App\Options\Customer::get('--Customer--')) !!}</div>
                <div class="col col-2">{!! Former::select('assetable_id','')->options(\App\Options\Facility::get('--Facility--')) !!}</div>
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
                <th>@include('components.sort-button',['sortField'=>'created_at']) Date Added</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Name</th>
                <th>@include('components.sort-button',['sortField'=>'key']) Key</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>@if($customer->logo)<img src="{{ $customer->logo->fileUrl() }}" width="50" />@endif</td>
                        <td>{{ $customer->created_at->format('m/d/Y g:ia') }}</td>
                        <td><a href="{{ url($customer->path()) }}">{{ $customer->name }}</a></td>
                        <td>{{ $customer->key }}</td>
                        <td><a href="{{ url($customer->path()) }}" class="btn btn-info">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $customers->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.customer.partials.scripts')
@endsection