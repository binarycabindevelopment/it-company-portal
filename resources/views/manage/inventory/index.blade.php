@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Product'])
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
                <th>Photo</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Name</th>
                <th>@include('components.sort-button',['sortField'=>'category'])Supplier</th>
                <th>@include('components.sort-button',['sortField'=>'retail_price_cents']) Category</th>
                <th>@include('components.sort-button',['sortField'=>'brand']) Brand</th>
                <th> Stock</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td><a href="{{ url($product->path()) }}" class="btn btn-primary">View</a></td>
                    <td>@if($product->image)<img src="{{ $product->image->fileUrl() }}" width="50" />@endif</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->supplier }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->brand }}</td>
                    <td>{{ $product->stock }}</td>
                    <th><a href="{{ url($product->path('/edit')) }}" class="btn btn-info btn-block">Edit</a></th>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $products->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.inventory.partials.scripts')
@endsection
