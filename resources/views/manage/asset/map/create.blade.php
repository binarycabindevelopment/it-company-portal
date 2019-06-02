@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Assets',
            '/manage/asset/'.$asset->id => $asset->name,
            '/manage/asset/'.$asset->id.'/map/create' => 'New Map',
        ],
    ])

    @component('components.panel',['title'=>'New Map For'])
       {!! Former::open_vertical('/manage/asset/'.$asset->id.'/map')->method('POST') !!}
        @include('manage.asset.map.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>

        {!! Former::close() !!}
    @endcomponent

@endsection
