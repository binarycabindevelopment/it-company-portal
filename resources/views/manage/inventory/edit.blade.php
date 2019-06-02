@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/inventory' => 'Product',
            url($product->path()) => $product->name,
            '' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '.$baseTitleSingular])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$product->id])
        @endslot
        {!! Former::open_vertical_for_files($baseRoute.'/'.$product->id)->method('PATCH') !!}
        {!! Former::populate($product) !!}
        @include('manage.inventory.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

@section('scripts')
    @include('manage.asset.partials.scripts')
@endsection
