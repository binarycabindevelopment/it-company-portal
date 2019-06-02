<?php

namespace Tests\Feature\Auth;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordResetTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_index(){
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
    }

    public function test_show(){
        $token = '4bf8c29f37e131dbd42f5005bd9730ab436587c2fb90633ffe1e730af94a5d87';
        $user = factory(\App\User::class)->create();
        \DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => \Hash::make($token),
        ]);
        $response = $this->get('/password/reset/'.$token);
        $response->assertStatus(200);
    }

    public function test_reset_password_token()
    {
        $password = str_random(10);
        $token = '4bf8c29f37e131dbd42f5005bd9730ab436587c2fb90633ffe1e730af94a5d87';
        $user = factory(\App\User::class)->create();
        \DB::table('password_resets')->insert([
            'email' => $user->email,
            'token' => \Hash::make($token),
        ]);
        $response = $this->post('/password/reset',[
            'token' => $token,
            'email' => $user->email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $authCheck = \Auth::attempt([
            'email' => $user->email,
            'password' => $password,
        ]);
        $this->assertTrue($authCheck);
        $response->assertStatus(302);
    }

}
