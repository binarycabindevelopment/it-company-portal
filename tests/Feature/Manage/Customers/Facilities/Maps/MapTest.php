<?php

namespace Tests\Feature\Manage\Customers\Facilities\Maps;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MapTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $response = $this->actingAs($auth)->get($facility->path('map/create'));
        $response->assertRedirect('/account');
    }
    
    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $response = $this->actingAs($auth)->get($facility->path('map/create'));
        $response->assertStatus(200);
    }

    /*public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $map = factory(\App\Map::class)->make();
        $response = $this->actingAs($auth)->post($facility->path('map'),[
            'name' => $map->name,
            'file' => $map->file,
        ]);
        $createdMap = \App\Map::where('name',$map->name)->first();
        $this->assertNotNull($createdMap);
        $this->assertNotNull($createdMap->uuid);
        $response->assertRedirect($createdMap->path());
        $facility = $facility->fresh();
        dump($createdMap);
        dump($facility);
        dd($facility->maps);
        $this->assertEquals(1, $facility->maps->count());
    }*/

}
