<?php

namespace Tests\Feature\Manage\Monitors;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MonitorTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/monitor');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitors = factory(\App\Monitor::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/monitor');
        $response->assertStatus(200);
        foreach($monitors as $monitor){
            $response->assertSee($monitor->url);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/monitor/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->make();
        $response = $this->actingAs($auth)->post('/manage/monitor',[
            'url' => $monitor->url,
        ]);
        $response->assertRedirect('/manage/monitor');
        $createdMonitor = \App\Monitor::where('url',$monitor->url)->first();
        $this->assertNotNull($createdMonitor);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->create();
        $response = $this->actingAs($auth)->get('/manage/monitor/'.$monitor->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->create();
        $response = $this->actingAs($auth)->get('/manage/monitor/'.$monitor->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->create();
        $monitorNew = factory(\App\Monitor::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/monitor/'.$monitor->id,[
            'url' => $monitorNew->url,
        ]);
        $response->assertRedirect($monitor->path());
        $updatedMonitor = \App\Monitor::find($monitor->id);
        $this->assertEquals($monitorNew->name,$updatedMonitor->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $monitor = factory(\App\Monitor::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/monitor/'.$monitor->id);
        $response->assertRedirect('/manage/monitor');
        $existingMonitor = \App\Monitor::find($monitor->id);
        $this->assertNull($existingMonitor);
    }

}
