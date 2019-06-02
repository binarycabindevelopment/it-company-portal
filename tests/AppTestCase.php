<?php

namespace Tests;

abstract class AppTestCase extends TestCase
{

    public function newUser($attributes = []){
        $user = factory(\App\User::class)->create($attributes);
        return $user;
    }

}
