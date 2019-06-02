<?php

namespace App;

use App\Support\Traits\HasAddresses;
use App\Support\Traits\HasContactTypes;
use App\Support\Traits\HasLinkedUsers;
use App\Support\Traits\HasPhones;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    use HasPhones;
    use HasAddresses;
    use HasContactTypes;
    use HasLinkedUsers;

    protected $fillable = [
        'contactable_id',
        'contactable_type',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'job_title',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
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
        $this->attributesSyncContactTypes($attributes);
    }

    public function getNameAttribute(){
        $name = $this->first_name;
        if(!empty($this->middle_name)){
            $name .= ' '.$this->middle_name;
        }
        $name .= ' '.$this->last_name;
        return $name;
    }

    public function contactable(){
        return $this->morphTo('contactable');
    }

}
