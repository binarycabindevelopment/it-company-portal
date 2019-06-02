<?php

namespace Tests\Feature\Dashboard;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_index_requires_authentication()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    public function test_index()
    {
        $user = $this->newUser();
        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

}
