<?php

namespace App\Support\Traits;

trait Filterable
{
    public function scopeFilter($query, array $filterData = [])
    {
        foreach ($filterData as $key => $value) {
            if ($this->isFilterable($key)) {
                if (is_null($value) || $value === '') continue;
                $scopeName = ucfirst(camel_case($key));
                if (method_exists($this, 'scope' . $scopeName)) {
                    $query->$scopeName($value);
                } else if (is_array($value)) {
                    $query->whereIn($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }
    }

    protected function isFilterable($key)
    {
        $filterable = $this->filterable ?: [];
        return in_array($key, $filterable);
    }

    public function scopeGlobal($query, $search){
        $filterableGlobalFields = $this->filterableGlobal;
        $query->where(function($query) use($filterableGlobalFields, $search) {
            foreach($filterableGlobalFields as $field){
                $query->orWhere($field,'like','%'.$search.'%');
            }
        });
        return $query;
    }

}