<?php

namespace App\Support\Traits;

trait HasLinkedUsers{

    public function linkedUsers(){
        return $this->morphMany(\App\LinkedUser::class, 'userable');
    }

    public function linkedUser(){
        return $this->morphOne(\App\LinkedUser::class,'userable');
    }

    public function getUsersAttribute(){
        $users = [];
        foreach($this->linkedUsers as $linkedUser){
            $users[] = $linkedUser->user;
        }
        return collect($users);
    }

    public function getUserAttribute(){
        if($this->users->count() > 0){
            return $this->users->first();
        }
        return null;
    }

    public function linkUser($user){
        return \App\LinkedUser::create([
            'user_id' => $user->id,
            'userable_id' => $this->id,
            'userable_type' => get_class($this),
        ]);
    }

}