<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasContact;
use App\Support\Traits\HasLinkedUsers;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    use HasUUID;
    use HasContact;
    use Filterable;
    use Sortable;
    use HasLinkedUsers;

    protected $fillable = [
        'uuid',
        'key',
    ];

    protected $filterable = [
        'key',
        'global',
    ];

    protected $filterableGlobal = [
        'key',
    ];

    protected $sortable = [
        'created_at',
        'key',
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
        $this->attributesSyncContact($attributes);
    }

    public function path($uri=null){
        $path = 'manage/employee/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function getNameAttribute(){
        if($this->contact && !empty($this->contact->name)){
            return $this->contact->name;
        }
        if($this->user && !empty($this->user->name)){
            return $this->user->name;
        }
        if($this->user && !empty($this->user->email)){
            return $this->user->email;
        }
        return '#'.$this->id;
    }

    public static function createOrGetDefault(){
        $defaultSchedule = static::getDefault();
        if($defaultSchedule==null){
            $defaultSchedule = static::createDefault();
        }
        return $defaultSchedule;
    }

    public static function getDefault(){
        return static::where('schedulable_id',1)->where('schedulable_type',\App\Employee::class)->first();
    }

    public static function createDefault(){
        $createData = [
            'schedulable_id' => 1,
            'schedulable_type' => \App\Employee::class,
        ];
        return static::create($createData);
    }

    public function schedule()
    {
        return $this->morphOne(\App\Schedule::class, 'schedulable');
    }

    public function payRates(){
        return $this->morphMany(\App\PayRate::class, 'payable');
    }





}
