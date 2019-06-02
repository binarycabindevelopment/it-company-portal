<?php

namespace Tests\Feature\Manage\Customers\Facilities;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FacilityTest extends AppTestCase
{

    use RefreshDatabase;

    private function newCustomer($attributes=[]){

    }

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get($customer->path('facility/create'));
        $response->assertRedirect('/account');
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get($customer->path('facility/create'));
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->make();
        $response = $this->actingAs($auth)->post($customer->path('facility'),[
            'name' => $facility->name,
            'key' => $facility->key,
            'sic_code' => $facility->sic_code,
            'tax_code' => $facility->tax_code,
            'tax_id' => $facility->tax_id,
            'number_of_employees' => $facility->number_of_employees,
            'annual_revenue' => $facility->annual_revenue,
        ]);
        $createdFacility = \App\Facility::where('name',$facility->name)->first();
        $response->assertRedirect($createdFacility->path());
        $this->assertNotNull($createdFacility);
        $this->assertNotNull($createdFacility->uuid);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->get($facility->path());
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->get($facility->path('/edit'));
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $facilityNew = factory(\App\Facility::class)->make();
        $response = $this->actingAs($auth)->patch($facility->path(),[
            'name' => $facilityNew->name,
        ]);
        $response->assertRedirect($facility->path());
        $updatedFacility = \App\Facility::find($facility->id);
        $this->assertEquals($facilityNew->name,$updatedFacility->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->delete($facility->path());
        $response->assertRedirect($customer->path());
        $existingFacility = \App\Facility::find($facility->id);
        $this->assertNull($existingFacility);
    }

}
