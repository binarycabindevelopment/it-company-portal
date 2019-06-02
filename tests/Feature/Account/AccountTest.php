<?php

namespace Tests\Feature\Account;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountTest extends AppTestCase
{

    use DatabaseMigrations;

    public function test_shows_sub_menu()
    {
        $auth = $this->newUser();
        $response = $this->actingAs($auth)->get('/account');
        $response->assertStatus(200);
        $response->assertSee('/account/user');
    }

}
