<?php

namespace Tests\Feature\Auth;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_create(){
        $auth = $this->newUser();
        $response = $this->actingAs($auth)->post('/logout');
        $authCheck = \Auth::check();
        $this->assertFalse($authCheck);
        $response->assertStatus(302);
    }

}
