<?php

namespace App;

use App\Support\Traits\HasCents;
use Illuminate\Database\Eloquent\Model;

class PayRate extends Model
{

    use HasCents;

    protected $fillable = [
        'payable_id',
        'payable_type',
        'hourly_amount_cents',
        'rate_charge_amount_cents',
    ];

    protected $centFields = [
        'hourly_amount_cents',
        'rate_charge_amount_cents',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::attributesDollarsToCents($attributes);
        $model = $query->create($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes = static::attributesDollarsToCents($attributes);
        $updateResponse = parent::update($attributes, $options);
        return $updateResponse;
    }

    public function getHourlyAmountAttribute(){
        return static::centsToDollars($this->hourly_amount_cents);
    }

    public function getRateChargeAmountAttribute(){
        return static::centsToDollars($this->rate_charge_amount_cents);
    }

    public function payable(){
        return $this->morphTo('payable');
    }

}
