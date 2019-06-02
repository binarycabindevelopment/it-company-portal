<?php

namespace App\Support\Traits;

trait HasLinkedEmployees{

    public function linkedEmployees(){
        return $this->morphMany(\App\LinkedEmployee::class, 'employeeable');
    }

    public function getEmployeesAttribute(){
        $employees = [];
        foreach($this->linkedEmployees as $linkedEmployee){
            $employees[] = $linkedEmployee->employee;
        }
        return collect($employees);
    }

    public function getDisplayEmployeesAttribute(){
        $items = [];
        foreach($this->employees as $employee){
            $items[] = $employee->name;
        }
        return implode(', ',$items);
    }

}