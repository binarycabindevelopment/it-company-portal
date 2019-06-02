<?php

namespace App\Repositories\Events;

class CalendarEventsRepository extends EventsRepository{

    public function get(){
        $events = $this->getResults();
        $results = [];
        foreach($events as $event){
            $eventResults = $event->getRecurringCalendarEvents();
            foreach($eventResults as $eventResult){
                $results[] = $eventResult;
            }
            //$results[] = $event->getCalendarData();
        }
        return $results;
    }

}