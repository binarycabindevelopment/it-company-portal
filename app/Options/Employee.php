<?php

namespace App\Options;

use KilroyWeb\Options\BaseOption;

class Employee extends BaseOption {

	public function getArray(){
        $items = [];
        $employees = \App\Employee::orderBy('key','ASC')->get();
        foreach($employees as $employee){
            $items[$employee->id] = $employee->key;
        }
        return $items;
    }

}