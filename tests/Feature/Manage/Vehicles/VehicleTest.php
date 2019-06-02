<?php

namespace Tests\Feature\Manage\Vehicles;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/vehicle');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicles = factory(\App\Vehicle::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/vehicle');
        $response->assertStatus(200);
        foreach($vehicles as $vehicle){
            $response->assertSee($vehicle->make);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/vehicle/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicle = factory(\App\Vehicle::class)->make();
        $response = $this->actingAs($auth)->post('/manage/vehicle',[
            'make' => $vehicle->make,
        ]);
        $response->assertRedirect('/manage/vehicle');
        $createdVehicle = \App\Vehicle::where('make',$vehicle->make)->first();
        $this->assertNotNull($createdVehicle);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicle = factory(\App\Vehicle::class)->create();
        $response = $this->actingAs($auth)->get('/manage/vehicle/'.$vehicle->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicle = factory(\App\Vehicle::class)->create();
        $response = $this->actingAs($auth)->get('/manage/vehicle/'.$vehicle->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicle = factory(\App\Vehicle::class)->create();
        $vehicleNew = factory(\App\Vehicle::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/vehicle/'.$vehicle->id,[
            'make' => $vehicleNew->make,
        ]);
        $response->assertRedirect($vehicle->path());
        $updatedVehicle = \App\Vehicle::find($vehicle->id);
        $this->assertEquals($vehicleNew->make,$updatedVehicle->make);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $vehicle = factory(\App\Vehicle::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/vehicle/'.$vehicle->id);
        $response->assertRedirect('/manage/vehicle');
        $existingVehicle = \App\Vehicle::find($vehicle->id);
        $this->assertNull($existingVehicle);
    }

}
