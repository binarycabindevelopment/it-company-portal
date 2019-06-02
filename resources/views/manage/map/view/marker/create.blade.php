@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/map/'.$map->id => $map->name,
            '/manage/map/'.$map->id.'/view' => 'Map Manager',
            '/manage/map/'.$map->id.'/view/marker/create' => 'New Marker',
        ],
    ])

    @component('components.panel',['title'=>'New Marker: '.$formData['type']])

        {!! Former::open_vertical('/manage/map/'.$map->id.'/view/marker')->method('POST') !!}
        {!! Former::populate($formData) !!}
        {!! Former::hidden('marker[x]')->value($formData['x']) !!}
        {!! Former::hidden('marker[y]')->value($formData['y']) !!}
        {!! Former::hidden('marker[map_id]')->value($map->id) !!}
        {!! Former::hidden('type')->value($formData['type']) !!}
        <div class="row">
            <div class="col-sm-3">
                {!! Former::text('marker[icon]','Icon')->readonly(true)->addClass('marker-icon') !!}
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" style="display:block;"> &nbsp;</label>
                    <div class="btn-group clearfix" style="display:block;">
                        <div class="pull-left" style="margin-right:10px;">
                            <img src="" class="marker-image" />
                        </div>
                        <div class="pull-left">
                            <button type="button" class="btn btn-default dropdown-toggle btn-block text-left" data-toggle="dropdown">
                                Select icon <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach(\App\Options\MarkerIcons::get() as $option)
                                    <li><a href="javascript:;" class="setIconClass" data-icon-value="{{ $option }}"><img src="{{ asset('/img/markers/'.$option.'.png') }}" /></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include($fieldsView,['update'=>false])
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}

    @endcomponent

@endsection
