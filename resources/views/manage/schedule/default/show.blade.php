@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/schedule/default' => 'Default Schedule',
        ],
    ])

    @component('components.panel',['title'=>'Default Schedule'])
        @slot('action')
            <a href="{{ url('/manage/schedule/default/edit') }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">
                    <div class="list-group-item list-group-item-light">
                        <strong>Start At: </strong>@if($schedule->start_at!=null) {{  $schedule->start_at->format('m/d/Y') }} @endif
                    </div>

                    <div class="list-group-item list-group-item-light">
                        <strong>End At: </strong>@if($schedule->end_at!=null) {{ $schedule->end_at->format('m/d/Y') }} @endif
                    </div>

                    <div class="list-group-item list-group-item-light">
                        <strong>Repeat: </strong>{{ $schedule->repeat }}
                    </div>
                </div>
                @include('components.schedule.calendar.calendar',['schedule'=>$schedule])
            </div>
            <div class="col-lg-5">
              @component('components.event.event-panel',[
                    'events'=>$schedule->events,
                    'basePath' => '/manage/schedule/default/event',
                ])
                @endcomponent
            </div>
        </div>

    @endcomponent


@endsection

@section('scripts')
    @include('components.schedule.calendar.calendar-scripts',['schedule'=>$schedule])
@endsection