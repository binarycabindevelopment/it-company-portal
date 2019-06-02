<?php

namespace Tests\Feature\Manage\Monitors\Pings;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PingTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_store(){
        $this->withoutExceptionHandling();
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->create();
        $response = $this->actingAs($auth)->post($monitor->path('/ping'),[]);
        $response->assertRedirect($monitor->path());
        $createdPing = \App\Ping::where('pingable_type',\App\Monitor::class)->where('pingable_id',$monitor->id)->first();
        $this->assertNotNull($createdPing);
    }

}
