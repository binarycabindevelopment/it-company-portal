<?php

namespace App\Http\Controllers\Manage\Employees\Schedules\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class EventController extends Controller
{


    public function create($employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule =  $employee->schedule;
        return view('manage.employee.schedule.event.create',[
            'schedule'=>$schedule,
            'employee'=>$employee
        ]);
    }

    public function store(Request $request,$employeeId){

        $employee = \App\Employee::findOrFail($employeeId);
        $schedule =  $employee->schedule;
        $eventData = $request->all();
        $eventData['eventable_id'] = $schedule->id;
        $eventData['eventable_type'] = get_class($schedule);
        $event = \App\Event::create($eventData);
        return redirect('/manage/employee/'.$employeeId.'/schedule/')->withSuccess('Saved');
    }

    public function edit($employeeId,$eventId){

        $employee = \App\Employee::findOrFail($employeeId);
        $schedule =  $employee->schedule;
        $event = $schedule->events()->where('id',$eventId)->first();
        return view('manage.employee.schedule.event.edit',[
            'schedule'=>$schedule,
            'event'=>$event,
            'employee'=>$employee
        ]);
    }

    public function update(Request $request,$employeeId,$eventId){
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule =  $employee->schedule;
        $event = $schedule->events()->where('id',$eventId)->first();
        $event->update($request->all());
        return redirect('/manage/employee/'.$employeeId.'/schedule/')->withSuccess('Saved');
    }

    public function destroy(Request $request, $employeeId,$eventId){
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule =  $employee->schedule;
        $event = $schedule->events()->where('id',$eventId)->first();
        $event->delete();
        return redirect('/manage/employee/'.$employeeId.'/schedule')->withSuccess('Deleted');
    }

}
