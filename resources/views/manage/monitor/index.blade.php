@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Monitor'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
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
                <th> Status</th>
                <th>Last Ping</th>
                <th>@include('components.sort-button',['sortField'=>'url']) Url</th>
            </tr>
            </thead>
            <tbody>

                @foreach($monitors as $monitor)


                    <tr>
                        <td><a href="{{ url( $monitor->path()) }}" class="btn btn-primary">View</a></td>
                        <td>
                            @include('manage.monitor.partials.status-badge',['monitor'=>$monitor])
                        </td>
                        <td>
                            @if($monitor->pingLast)
                                {{ $monitor->pingLast->created_at->format('m/d/Y g:ia') }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ $monitor->url }}" target="_blank">{{ $monitor->url }} <span
                                        class="fa fa-external-link"></span></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $monitors->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.monitor.partials.scripts')
@endsection
