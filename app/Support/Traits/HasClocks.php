<?php

namespace App\Support\Traits;

trait HasClocks{

    public function clocks(){
        return $this->morphMany(\App\Clock::class,'clockable');
    }

    public function getLastClockIn(){
        return $this->clocks()->latest()->first();
    }

    public function getClockedInClock(){
        return $this->clocks()->whereNull('closed_at')->first();
    }

    public function clockedIn(){
        if($this->getClockedInClock()){
            return true;
        }
        return false;
    }

    public function clockIn(){
        if(!$this->clockedIn()){
            $clock = \App\Clock::create([
                'clockable_id' => $this->id,
                'clockable_type' => get_class($this),
            ]);
            return $clock;
        }
        return $this->getClockedInClock();
    }

    public function clockOut(){
        $clockedInClocks = $this->clocks()->whereNull('closed_at')->get();
        foreach($clockedInClocks as $clockedInClock){
            $clockedInClock->close();
        }
    }

}