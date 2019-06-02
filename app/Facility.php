<?php

namespace App;

use App\Support\Traits\HasAddresses;
use App\Support\Traits\HasImage;
use App\Support\Traits\HasLinkedContacts;
use App\Support\Traits\HasLinks;
use App\Support\Traits\HasMaps;
use App\Support\Traits\HasPhones;
use App\Support\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{

    use HasUUID;
    use HasPhones;
    use HasAddresses;
    use HasLinks;
    use HasImage;
    use HasMaps;
    use HasLinkedContacts;

    protected $fillable = [
        'uuid',
        'facilityable_type',
        'facilityable_id',
        'name',
        'key',
        'number_of_employees',
        'annual_revenue_cents'
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addUuidToAttributesIfEmpty($attributes);
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
        $this->attributesUpdateImage($attributes);
    }

    public function path($uri=null){
        $path = 'manage/customer/'.$this->facilityable_id.'/facility/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function facilityable(){
        return $this->morphTo('facilityable');
    }

}
