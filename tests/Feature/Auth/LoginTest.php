<?php

namespace Tests\Feature\Auth;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_create_redirects_if_authenticated()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/');
    }

    public function test_create()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_store(){
        $password = str_random(10);
        $user = factory(\App\User::class)->create([
            'password' => \Hash::make($password),
        ]);
        $response = $this->post('/login',[
            'email' => $user->email,
            'password' => $password,
        ]);
        $authCheck = \Auth::check();
        $this->assertTrue($authCheck);
        $response->assertStatus(302);
    }

}
