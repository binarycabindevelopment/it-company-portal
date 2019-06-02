<?php

namespace App\Support\Traits;

trait HasCents{

    public static function attributesDollarsToCents($attributes){
        $instance = new static;
        foreach($instance->centFields as $centField){
            $dollarField = str_replace('_cents','',$centField);
            if(isset($attributes[$dollarField])){
                $attributes[$centField] = static::dollarsToCents($attributes[$dollarField]);
            }
        }
        return $attributes;
    }

    public static function dollarsToCents($dollars){
        $dollars = preg_replace("/[^0-9.]/", "", $dollars);
        $dollars = floatval($dollars);
        $dollars = number_format($dollars,2,'.','');
        if($dollars > 0){
            $cents = $dollars * 100;
            $cents = round($cents);
            return $cents;
        }
        return 0;
    }

    public static function centsToDollars($cents){
        if($cents > 0){
            $dollars = $cents/100;
            return $dollars;
        }
        return 0;
    }

}