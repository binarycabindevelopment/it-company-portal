<?php

namespace Tests\Feature\Manage\Customers;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/customer');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customers = factory(\App\Customer::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/customer');
        $response->assertStatus(200);
        foreach($customers as $customer){
            $response->assertSee($customer->created_at->format('m/d/Y'));
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/customer/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->make();
        $response = $this->actingAs($auth)->post('/manage/customer',[
            'name' => $customer->name,
            'key' => $customer->key,
            'sic_code' => $customer->sic_code,
            'tax_code' => $customer->tax_code,
            'tax_id' => $customer->tax_id,
            'number_of_employees' => $customer->number_of_employees,
            'annual_revenue' => $customer->annual_revenue,
        ]);
        $response->assertRedirect('/manage/customer');
        $createdCustomer = \App\Customer::where('name',$customer->name)->first();
        $this->assertNotNull($createdCustomer);
        $this->assertNotNull($createdCustomer->uuid);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get('/manage/customer/'.$customer->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get('/manage/customer/'.$customer->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $customerNew = factory(\App\Customer::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/customer/'.$customer->id,[
            'name' => $customerNew->name,
        ]);
        $response->assertRedirect($customer->path());
        $updatedCustomer = \App\Customer::find($customer->id);
        $this->assertEquals($customerNew->name,$updatedCustomer->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/customer/'.$customer->id);
        $response->assertRedirect('/manage/customer');
        $existingCustomer = \App\Customer::find($customer->id);
        $this->assertNull($existingCustomer);
    }

}
