<?php

namespace App;

use App\Support\Traits\HasCreatedAt;
use App\Support\Traits\HasLinkedEmployees;
use Illuminate\Database\Eloquent\Model;


use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasLinkedContacts;
use App\Support\Traits\HasDateInputs;
use App\Support\Traits\HasLinks;
use App\Support\Traits\HasUUID;
use App\Support\Traits\Sortable;
use App\Support\Traits\HasLinkedFacilities;

class Ticket extends Model
{

    use Filterable;
    use Sortable;
    use HasUUID;
    use HasLinks;
    use HasLinkedContacts;
    use HasLinkedEmployees;
    use HasDateInputs;
    use HasAuthorUser;
    use HasLinkedFacilities;
    use HasCreatedAt;

    protected $fillable = [
        'uuid',
        'author_user_id',
        'title',
        'service_board',
        'ticketable_type',
        'ticketable_id',
        'status',
        'type',
        'sub_type',
        'item',
        'source',
        'priority',
        'summary',
        'details',
        'analysis',
        'resolution',
        'configuration_name',
        'resource_member',
        'completed_at',
    ];
    protected $dates = [
        'completed_at',
        'created_at'
    ];

    protected $dateInputs = [
        'completed_at'
    ];

    protected $filterable = [
        'uuid',
        'title',
        'status',
        'type',
        'ticketable_id',
        'global',
    ];
    protected $filterableGlobal = [
        'uuid',
        'title',
        'status',
        'type',
        'ticketable_id',
        'item'
    ];

    protected $sortable = [
        'name',
        'type',
        'item',
        'source',
        'priority',
        'completed_at',
        'created_at',
    ];

    protected $appends = [
        'display_created_at_diff',
        'display_status',
        'display_status_icon',
        'display_contacts',
        'display_employees',
        'display_summary',
        'display_company_and_facility',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
        $attributes = static::addUuidToAttributesIfEmpty($attributes);
        $attributes = static::addSetDateOnAttributes($attributes);
        $model = $query->create($attributes);

        $model->postSave($attributes);

        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes = static::addSetDateOnAttributes($attributes);
        $updateResponse = parent::update($attributes, $options);
        $this->postSave($attributes);
        return $updateResponse;
    }

    public function postSave(array $attributes = []){
    }

    public function getCompletedAtInputAttribute(){
        return $this->completed_at->format('m/d/Y h:i');
    }
    public function getCreatedAtInputAttribute(){
        return $this->created_at->format('m/d/Y h:i');
    }

    public function path($uri=null){
        $path = 'manage/ticket/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function notes(){
        return $this->morphMany('App\Note', 'notable');
    }

    public function ticketable(){
        return $this->morphTo('ticketable');
    }

    public function getDisplayStatusAttribute(){
        return ucwords($this->status);
    }

    public function getDisplayStatusIconAttribute(){
        if($this->status == 'Open'){
            return '<i class="fa fa-circle text-warning"></i>';
        }
        return '<i class="fa fa-circle text-success"></i>';
    }

    public function getDisplaySummaryAttribute(){
        return '<a href="'.url('/manage/ticket/'.$this->id).'">'.$this->title.'</a>';
    }



}
