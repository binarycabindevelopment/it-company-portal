<?php

namespace Tests\Feature\Auth;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PasswordEmailTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_store()
    {
        $user = factory(\App\User::class)->create();
        $response = $this->post('/password/email',[
            'email' => $user->email,
        ]);
        $createdToken = \DB::table('password_resets')->where('email',$user->email)->first();
        $this->assertNotEmpty($createdToken->token);
    }

}
