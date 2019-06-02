@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Assets',
            '/manage/asset/'.$asset->id => $asset->name,
            '/manage/asset/'.$asset->id.'/map/create' => 'Link Asset',
        ],
    ])

    @component('components.panel',['title'=>'Link Asset For'])
       {!! Former::open_vertical('/manage/asset/'.$asset->id.'/asset')->method('POST') !!}
        @include('manage.asset.asset.partials.fields',['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>

        {!! Former::close() !!}
    @endcomponent

@endsection
