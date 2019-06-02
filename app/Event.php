<?php

namespace App;

use App\Support\Traits\HasAuthorUser;
use App\Support\Traits\HasDateInputs;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    use HasAuthorUser;
    use HasDateInputs;

    protected $fillable = [
        'author_user_id',
        'eventable_id',
        'eventable_type',
        'start_at',
        'end_at',
        'name',
        'details',
        'repeat',
        'type',
        'constraint',
    ];

    protected $dates = [
        'start_at',
        'end_at'
    ];

    protected $dateInputs = [
        'start_at',
        'end_at',
    ];

    public static function create(array $attributes = [])
    {
        $query = static::query();
        $attributes = static::addAuthorUserIdToAttributes($attributes);
        $attributes = static::addSetDateOnAttributes($attributes);
        $model = $query->create($attributes);
        return $model;
    }

    public function update(array $attributes = [], array $options = [])
    {
        $attributes = static::addSetDateOnAttributes($attributes);
        $updateResponse = parent::update($attributes, $options);
        return $updateResponse;
    }


    public function eventable(){
        return $this->morphTo('eventable');
    }

    public function getStartAtInputAttribute(){
        return $this->start_at!=null ? $this->start_at->format('m/d/Y') : '';
    }
    public function getEndAtInputAttribute(){
        return $this->end_at!=null ? $this->end_at->format('m/d/Y') : '';
    }

    public function getConstraintEvent(){
        $constraint = \App\Event::where('constraint',true)
            ->where('start_at','>',$this->start_at)
            ->where('start_at','<',$this->start_at)
            ->first();
        if($constraint){
            return $constraint;
        }
        //else find all repeat=dayofweek and date = dayofweek
        $possibleConstraintsResults = \App\Event::query()
            ->whereRaw('DAYOFWEEK(start_at) = DAYOFWEEK("'.$this->start_at->format('Y-m-d').'")')
            ->where('constraint','=',true)
            ->get();
        if($possibleConstraintsResults->count() > 0){
            return $possibleConstraintsResults->first();
        }
        return null;
    }

    public function getCalendarConstraint(){
        if(!$this->constraint){
            $constraintEvent = $this->getConstraintEvent();
            if($constraintEvent){
                $data = [
                    'start' => $constraintEvent->start_at->format('Y-m-d g:h'),
                    'end' => $constraintEvent->end_at->format('Y-m-d g:h'),
                ];
                return $data;
            }
        }
        return null;
    }

    //TODO - Depricate
    public function getCalendarData(){
        $data = [
            'id' => $this->id,
            'title' => $this->name,
            'start' => $this->start_at->format('Y-m-d g:h'),
            'end' => $this->end_at->format('Y-m-d g:h'),
        ];
        $constraint = $this->getCalendarConstraint();
        if($constraint){
            $data['constraint'] = $constraint;
        }
        return $data;
    }

    public function getRecurringCalendarEvents(){
        $results = [];
        $results[] = $this->getCalendarData();
        //TODO - Get yearly
        //TODO - Get monthly
        //TODO -- Get weekly
        $results = collect($results);
        return $results;
    }
}
