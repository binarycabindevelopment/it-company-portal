<?php

namespace App\Support\Traits;

trait Sortable
{
    public function scopeSort($query, array $sortData = [])
    {
        $sortField = $this->sortFieldDefault;
        $sortOrder = $this->sortOrderDefault;
        if(!$sortField){
            $sortField = 'id';
        }
        if(!$sortOrder){
            $sortOrder = 'ASC';
        }
        if(!empty($sortData['sort'])){
            $sortField = $sortData['sort'];
        }
        if(!empty($sortData['sort_order'])){
            $sortOrder = $sortData['sort_order'];
        }
        return $query->orderBy($sortField, $sortOrder);
    }

}