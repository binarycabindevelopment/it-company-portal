<?php

namespace Tests\Feature\Account;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountUserTest extends AppTestCase
{

    use DatabaseMigrations;

    public function test_show()
    {
        $auth = $this->newUser();
        $response = $this->actingAs($auth)->get('/account/user');
        $response->assertStatus(200);
        $response->assertSee($auth->email);
    }

    public function test_can_update_display_name()
    {
        $auth = $this->newUser();
        $newUser = factory(\App\User::class)->make();
        $response = $this->actingAs($auth)->patch('/account/user',[
            'first_name' => $newUser->first_name,
            'last_name' => $newUser->last_name,
        ]);
        $auth = $auth->fresh();
        $this->assertEquals($newUser->first_name,$auth->first_name);
        $this->assertEquals($newUser->last_name,$auth->last_name);
    }

    public function test_can_update_email()
    {
        $auth = $this->newUser();
        $newUser = factory(\App\User::class)->make();
        $response = $this->actingAs($auth)->patch('/account/user',[
            'email' => $newUser->email,
        ]);
        $auth = $auth->fresh();
        $this->assertEquals($newUser->email,$auth->email);
    }

    public function test_can_update_password()
    {
        $auth = $this->newUser();
        $newPassword = 'NewPass1234';
        $response = $this->actingAs($auth)->patch('/account/user',[
            'password' => $newPassword,
        ]);
        $authAttempt = \Auth::attempt([
            'email' => $auth->email,
            'password' => $newPassword,
        ]);
        $this->assertTrue($authAttempt);
    }

}
