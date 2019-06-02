@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/schedule/default' => 'Default Schedule',
            '/manage/schedule/default/edit' => 'Edit',
        ],
    ])

    @component('components.panel',['title'=>'Update '])
        @slot('action')
            @include('components.delete-button',['url'=>$baseRoute.'/'.$schedule->id])
        @endslot
        {!! Former::open_vertical_for_files('/manage/schedule/default')->method('PATCH') !!}
        {!! Former::populate($schedule) !!}
        @include('manage.schedule.default.partials.fields',['update'=>true])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection

