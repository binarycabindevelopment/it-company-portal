<?php

namespace App\Repositories\Events;

class EventsRepository{

    protected $start;
    protected $end;
    protected $schedule;

    public function filterStart($start){
        $this->start = $start;
    }

    public function filterEnd($end){
        $this->end = $end;
    }

    public function filterSchedule($schedule){
        $this->schedule = $schedule;
    }

    public function getResults(){
        $query = \App\Event::query();
        if(!empty($this->start)){
            $query->where('start_at', '>', $this->start);
        }
        if(!empty($this->end)){
            $query->where('end_at', '<', $this->end);
        }
        if(!empty($this->schedule)){
            $query->where('eventable_id', '=', $this->schedule->id);
            $query->where('eventable_type', '=', get_class($this->schedule));
        }
        $results = $query->get();
        return $results;
    }

    public function get(){
        $results = $this->getResults();
        return $results;
    }

}