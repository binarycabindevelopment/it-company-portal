<?php

namespace App\Http\Controllers\API\Calendars\Schedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    public function show(Request $request, $scheduleId){
        $schedule = \App\Schedule::findOrFail($scheduleId);
        $calendarEventsRepository = new \App\Repositories\Events\CalendarEventsRepository();
        if($request->start){
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$request->start);
            $calendarEventsRepository->filterStart($start);
        }
        if($request->end){
            $end = \Carbon\Carbon::createFromFormat('Y-m-d', $request->end);
            $calendarEventsRepository->filterEnd($end);
        }
        $calendarEventsRepository->filterSchedule($schedule);
        return response()->json($calendarEventsRepository->get());
    }

}
