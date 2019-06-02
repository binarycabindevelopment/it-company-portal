@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Map'])

        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span
                        class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-3">{!! Former::select('customer_id','')->options(\App\Options\Customer::get('--Customer--')) !!}</div>
                <div class="col col-3">{!! Former::select('mappable_id','')->options(\App\Options\Facility::get('--Facility--')) !!}</div>
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
                <th>&nbsp;</th>
                <th>Customer</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Name</th>
            </tr>
            </thead>
            <tbody>

            @foreach($maps as $map)
                <tr>
                    <td><a href="{{ url( $map->path()) }}" class="btn btn-primary">View</a></td>
                    <td>
                        @if($map->image)
                            <p><img src="{{ $map->image->fileUrl() }}" class="img-fluid" width="100"/></p>
                        @endif
                    </td>
                    <td>
                        @if($map->mappable)
                            @if($map->mappable->facilityable)
                                <a href="{{ url($map->mappable->facilityable->path()) }}">{{ $map->mappable->facilityable->name }}</a>
                                <br/>
                            @endif
                            <em><a href="{{ url($map->mappable->path()) }}">{{ $map->mappable->name }}</a></em>
                        @endif
                    </td>
                    <td>
                        {{ $map->name }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $maps->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.map.partials.scripts')
@endsection
