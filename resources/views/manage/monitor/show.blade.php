@extends('layouts.app')
@section('content')
    @include('components.breadcrumb',[
        'links' => [
            '/manage/monitor' => 'Monitors',
            '/manage/monitor/'.$monitor->id => $monitor->url,
        ],
    ])
    @component('components.panel',['title'=>$monitor->url])
        @slot('action')
            <a href="{{ url($monitor->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot

        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col">
                        @component('components.panel',['title'=>'Current Status','additionalClasses'=>'mb-2'])
                            <h2 class="text-center">@include('manage.monitor.partials.status-badge',['monitor'=>$monitor])</h2>
                            @if($monitor->pingLast)
                                <p class="text-center"><small>As of
                                        {{ $monitor->pingLast->created_at->format('m/d/Y g:ia') }}</small></p>
                            @endif
                        @endcomponent
                    </div>
                    <div class="col">
                        @component('components.panel',['title'=>'Expected Status Code','additionalClasses'=>'mb-2'])
                            <h2 class="text-center">{{ $monitor->expected_status_code }}</h2>
                        @endcomponent
                    </div>
                    @if($monitor->expected_response_content)
                        <div class="col">
                            @component('components.panel',['title'=>'Expected Content','additionalClasses'=>'mb-2'])
                                <h2 class="text-center">{{ $monitor->expected_response_content }}</h2>
                            @endcomponent
                        </div>
                    @endif
                </div>
                <div class="list-group">
                    @if($monitor->url)
                        <div class="list-group-item list-group-item-light">
                            <strong><a href="{{ $monitor->url }}" target="_blank">{{ $monitor->url }} <span
                                            class="fa fa-external-link"></span></a></strong>
                        </div>
                    @endif
                    @if($monitor->expected_status_code)
                        <div class="list-group-item list-group-item-light">
                            <strong>Expected Status Code: </strong> {{ $monitor->expected_status_code }}
                        </div>
                    @endif
                    @if($monitor->expected_response_content)
                        <div class="list-group-item list-group-item-light">
                            <strong>Expected Response Content: </strong> {{ $monitor->expected_response_content }}
                        </div>
                    @endif
                    @if($monitor->created_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Created Date and Time: </strong> {{ $monitor->created_at }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col">
                @component('components.panel',['title'=>'Ping History','additionalClasses'=>'mb-2'])
                    @slot('action')
                        {!! Former::open_vertical('/manage/monitor/'.$monitor->id.'/ping')->method('POST') !!}
                        <button type="submit" class="btn btn-info">Ping <span class="fa fa-globe"></span></button>
                        {!! Former::close() !!}
                    @endslot
                    <div class="list-group">
                        @foreach($monitor->pings as $ping)
                            <div class="list-group-item list-group-item-light">
                                <span class="badge @if($ping->status_code == $monitor->expected_status_code) badge-success @else badge-danger @endif">{{ $ping->status_code }}</span>
                                {{ $ping->created_at->format('m/d/Y g:ia') }}
                            </div>
                        @endforeach
                    </div>
                @endcomponent
            </div>
        </div>
    @endcomponent
@endsection
