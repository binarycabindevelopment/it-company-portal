<?php

namespace App\Support\Traits;

trait HasLinkedFacilities{

    public function linkedFacilities(){
        return $this->morphMany(\App\LinkedFacility::class, 'facilityable');
    }

    public function getFacilitiesAttribute(){

        $facilities = [];
        if(count($this->linkedFacilities)>0){
            foreach($this->linkedFacilities as $facilable){
                $facilities[] = $facilable->facility;
            }  
        }  else {
            $facilities =[];
        }   
        return collect($facilities);
    }

    public function linkFacility($ticket, $ticketData){
        return \App\LinkedFacility::create([
            'facilityable_id' => $this->id,
            'facilityable_type' => get_class($this),
            'facility_id' => $ticketData['facility_id'],
        ]);
    }

    public function getDisplayCompanyAndFacilityAttribute(){
        if($this->facilities->count() > 0){
            $facility = $this->facilities->first();
            $companyName = null;
            if($facility->facilityable){
                $companyName = $facility->facilityable->name;
            }
            $facilityName = $facility->name;
            return '<strong>'.$companyName.'</strong><br/>'.$facilityName;
        }
        return null;
    }

}