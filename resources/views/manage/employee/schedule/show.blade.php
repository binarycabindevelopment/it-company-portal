<?php
$title = $employee->name;
if (!empty($employee->key)) {
    $title .= ' (' . $employee->key . ')';
}
?>
@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/schedule' => 'Schedule',
        ],
    ])

    @include('manage.employee.partials.subnav')

    @component('components.panel',['title'=>$title])
        @slot('action')
            <a href="{{ url($employee->path('/schedule/'.$schedule->id.'/edit')) }}" class="btn btn-primary">Edit</a>
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
                @component('components.event.employee-schedule-event-panel',[
                      'events'=>$schedule->events,
                      'basePath' => '/manage/employee/'.$employee->id.'/schedule/event',
                  ])
                @endcomponent
            </div>
        </div>

    @endcomponent


@endsection

@section('scripts')
    @include('components.schedule.calendar.calendar-scripts',['schedule'=>$schedule])
@endsection
