<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAddresses;
use App\Support\Traits\HasCents;
use App\Support\Traits\HasContacts;
use App\Support\Traits\HasLinks;
use App\Support\Traits\HasLogo;
use App\Support\Traits\HasPhones;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasUUID;
    use HasPhones;
    use HasAddresses;
    use HasLinks;
    use HasContacts;
    use Filterable;
    use Sortable;
    use HasLogo;
    use HasCents;

    protected $fillable = [
        'uuid',
        'name',
        'key',
        'sic_code',
        'tax_code',
        'tax_id',
        'number_of_employees',
        'annual_revenue_cents',
    ];

    protected $filterable = [
        'uuid',
        'name',
        'key',
        'global',
    ];

    protected $filterableGlobal = [
        'uuid',
        'name',
        'key',
    ];

    protected $sortable = [
        'created_at',
        'name',
        'key',
        'number_of_employees',
        'annual_revenue_cents',
    ];

    protected $centFields = [
        'annual_revenue_cents',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addUuidToAttributesIfEmpty($attributes);
        $attributes = static::attributesDollarsToCents($attributes);
        $model = $query->create($attributes);
        $model->postSave($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $updateResponse = parent::update($attributes, $options);
        $this->postSave($attributes);
        return $updateResponse;
    }

    public function postSave(array $attributes = []){
        $this->attributesSyncPhones($attributes);
        $this->attributesSyncAddresses($attributes);
        $this->attributesSyncLinks($attributes);
        $this->attributesUpdateLogo($attributes);
    }

    public function path($uri=null){
        $path = 'manage/customer/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function facilities(){
        return $this->morphMany(\App\Facility::class, 'facilityable');
    }

    public function getAnnualRevenueAttribute(){
        return static::centsToDollars($this->annual_revenue_cents);
    }
    public function tickets(){
        return $this->morphMany(\App\Ticket::class,'ticketable');
    }




}
