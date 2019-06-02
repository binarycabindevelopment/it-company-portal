<?php

namespace App\Http\Controllers\Manage\Employees\Schedules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{

    public function show($employeeId)
    {
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule = $employee->schedule;
        if($schedule==null){
            $schedule =  static::createDefault($employeeId);
        }
        return view('manage.employee.schedule.show',['employee'=>$employee,'schedule'=>$schedule]);
    }

    public static function createDefault($employeeId){
        $createData = [
            'schedulable_id' => $employeeId,
            'schedulable_type' => \App\Employee::class,
        ];
        return \App\Schedule::create($createData);
    }

    public function edit($employeeId)
    {
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule = $employee->schedule;
        return view('manage.employee.schedule.edit',['employee'=>$employee,'schedule'=>$schedule]);
    }

    public function update(Request $request,$employeeId)
    {
        $employee = \App\Employee::findOrFail($employeeId);
        $schedule = $employee->schedule;
        $schedule->update($request->all());
        return redirect($employee->path().'/schedule')->withSuccess('Saved!');
    }

}
