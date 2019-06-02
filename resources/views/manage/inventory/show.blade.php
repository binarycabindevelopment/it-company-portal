@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/inventory' => 'Products',
            '/manage/inventory/'.$product->id => $product->name,
        ],
    ])

    @component('components.panel',['title'=>$product->name])
        @slot('action')
            <a href="{{ url($product->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">
                    @if($product->name)
                        <div class="list-group-item list-group-item-light">
                            <strong>Name: </strong> {{ $product->name }}
                        </div>
                    @endif
                    @if($product->sku)
                        <div class="list-group-item list-group-item-light">
                            <strong>SKU: </strong> {{ $product->sku }}
                        </div>
                    @endif
                    @if($product->category)
                        <div class="list-group-item list-group-item-light">
                            <strong>Category: </strong> {{ $product->category }}
                        </div>
                    @endif
                    @if($product->supplier)
                        <div class="list-group-item list-group-item-light">
                            <strong>Supplier: </strong> {{ $product->supplier }}
                        </div>
                    @endif
                    @if($product->brand)
                        <div class="list-group-item list-group-item-light">
                            <strong>Brand: </strong> {{ $product->brand }}
                        </div>
                    @endif
                    @if($product->description)
                        <div class="list-group-item list-group-item-light">
                            <strong>Description: </strong> {{ $product->description }}
                        </div>
                    @endif
                    @if($product->buy_price)
                        <div class="list-group-item list-group-item-light">
                            <strong>Price($): </strong>{{ $product->buy_price }}
                        </div>
                    @endif
                    @if($product->wholesale_price)
                        <div class="list-group-item list-group-item-light">
                            <strong>Wholesale Price($): </strong>{{ $product->wholesale_price }}
                        </div>
                    @endif
                    @if($product->retail_price)
                        <div class="list-group-item list-group-item-light">
                            <strong>Retail Price($): </strong>{{ $product->retail_price }}
                        </div>
                    @endif
                    @if($product->stock)
                        <div class="list-group-item list-group-item-light">
                            <strong>Stock: </strong> {{ $product->stock }}
                        </div>
                    @endif
                    @if($product->created_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Created At: </strong> {{ $product->created_at->format('m/d/Y g:ia') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5">
            </div>
        </div>

    @endcomponent

@endsection
