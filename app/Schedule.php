<?php

namespace App;

use App\Support\Traits\Filterable;
use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasDateInputs;
use App\Support\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{

    use Filterable;
    use Sortable;
    use HasDateInputs;
    use HasAuthorUser;

    protected $fillable = [
        'author_user_id',
        'schedulable_id',
        'schedulable_type',
        'start_at',
        'end_at',
        'repeat'
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    protected $dateInputs = [
        'start_at',
        'end_at',
    ];

    public static function createOrGetDefault(){
        $defaultSchedule = static::getDefault();
        if($defaultSchedule==null){
            $defaultSchedule = static::createDefault();
        }
        return $defaultSchedule;
    }

    public static function getDefault(){

        return static::where('schedulable_id',1)->where('schedulable_type',\App\Portal\App::class)->first();
    }

    public static function createDefault(){
        $createData = [
            'schedulable_id' => 1,
            'schedulable_type' => \App\Portal\App::class,
        ];
        return static::create($createData);
    }

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
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

    public function postSave(array $attributes = [])
    {

    }

    public function path($uri=null){
        $path = 'manage/schedule/'.$this->id;
        return \App\Support\Formatters\PathFormatter::path($path, $uri);
    }

    public function getStartAtInputAttribute(){
        return $this->start_at!=null ? $this->start_at->format('m/d/Y') : '';
    }
    public function getEndAtInputAttribute(){
        return $this->end_at!=null ? $this->end_at->format('m/d/Y') : '';
    }

    public function events(){
        return $this->morphMany('App\Event', 'eventable');
    }
    public function schedulable()
    {
        return $this->morphTo('schedulable');
    }

    //TODO - Depricate to the CalendarEventsRepository
    public function getCalendarEvents(){
        $events = [];
        foreach($this->events as $event){
            $events[] = $event->getCalendarData();
        }
        return $events;
    }

}
