<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class NumericRange extends BaseOption {

	public function getArray(){
	    $start = 1;
	    $end = 10;
	    if(isset($this->attributes['start'])){
            $start = $this->attributes['start'];
        }
        if(isset($this->attributes['end'])){
            $end = $this->attributes['end'];
        }
        $items = [];
        for($i=$start;$i<=$end;$i++){
            $value = (string) $i;
            $items[$value] = $value;
        }
        return $items;
    }

}