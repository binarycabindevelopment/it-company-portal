<?php

namespace App\Http\Controllers\Manage\Schedules\Defaults\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class EventController extends Controller
{


    public function create(){
        $schedule = \App\Schedule::createOrGetDefault();
        return view('manage.schedule.default.event.create',[
            'schedule'=>$schedule,
        ]);
    }

    public function store(Request $request){
        $schedule = \App\Schedule::createOrGetDefault();
        $eventData = $request->all();
        $eventData['eventable_id'] = $schedule->id;
        $eventData['eventable_type'] = get_class($schedule);
        $event = \App\Event::create($eventData);
        return redirect('/manage/schedule/default')->withSuccess('Saved');
    }

    public function edit($eventId){
        $schedule = \App\Schedule::createOrGetDefault();
        $event = $schedule->events()->where('id',$eventId)->first();
        return view('manage.schedule.default.event.edit',[
            'schedule'=>$schedule,
            'event'=>$event,
        ]);
    }

    public function update(Request $request, $eventId){
        $schedule = \App\Schedule::createOrGetDefault();
        $event = $schedule->events()->where('id',$eventId)->first();
        $event->update($request->all());
        return redirect('/manage/schedule/default')->withSuccess('Saved');
    }

    public function destroy(Request $request, $eventId){
        $schedule = \App\Schedule::createOrGetDefault();
        $event = $schedule->events()->where('id',$eventId)->first();
        $event->delete();
        return redirect('/manage/schedule/default')->withSuccess('Deleted');
    }

}
