<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'type',
        'address_1',
        'address_2',
        'city',
        'state',
        'zipcode',
        'county',
        'country',
    ];

    public function getFullHtmlAttribute(){
        $output = [];
        $output[] = $this->address_1;
        if(!empty($this->address_2)){
            $output[] = $this->address_2;
        }
        $output[] = $this->city.', '.$this->state.' '.$this->zipcode;
        $output = implode("<br/>",$output);
        return $output;
    }
}
