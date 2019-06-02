<?php

namespace App\Support\Traits;

trait HasDateInputs {

    //TODO - deprecate all uses of this and use static::addSetDateOnAttributes() instead
    public function attributesSetDates($attributes = []) {
        foreach ($this->dateInputs as $dateInput) {
            $dateInputField = $dateInput . '_input';
            if (isset($attributes[$dateInputField])) {
                if (!empty($attributes[$dateInputField])) {
                    $attributes[$dateInput] = \Carbon\Carbon::parse($attributes[$dateInputField]);
                } else {
                    $attributes[$dateInput] = null;
                }
                $this->update([
                    $dateInput => $attributes[$dateInput],
                ]);
            }
        }
        return $attributes;
    }

    public static function addSetDateOnAttributes($attributes = []) {
        $instance = new static;
        foreach ($instance->dateInputs as $dateInput) {
            $dateInputField = $dateInput . '_input';
            if (isset($attributes[$dateInputField])) {
                if (!empty($attributes[$dateInputField])) {
                    try {
                        $attributes[$dateInput] = \Carbon\Carbon::parse($attributes[$dateInputField]);
                    } catch (\Exception $e) {
                        //
                    }
                } else {
                    $attributes[$dateInput] = null;
                }
            }
        }
        return $attributes;
    }

}