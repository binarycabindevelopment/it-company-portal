<?php

namespace Tests\Feature\Manage\SupportVendors;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupportVendorTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/support-vendor');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $supportVendors = factory(\App\SupportVendor::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/support-vendor');
        $response->assertStatus(200);
        foreach($supportVendors as $supportVendor){
            $response->assertSee($supportVendor->name);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/support-vendor/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $supportVendor = factory(\App\SupportVendor::class)->make();
        $response = $this->actingAs($auth)->post('/manage/support-vendor',[
            'name' => $supportVendor->name,
        ]);
        $response->assertRedirect('/manage/support-vendor');
        $createdSupportVendor = \App\SupportVendor::where('name',$supportVendor->name)->first();
        $this->assertNotNull($createdSupportVendor);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $supportVendor = factory(\App\SupportVendor::class)->create();
        $response = $this->actingAs($auth)->get('/manage/support-vendor/'.$supportVendor->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $supportVendor = factory(\App\SupportVendor::class)->create();
        $supportVendorNew = factory(\App\SupportVendor::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/support-vendor/'.$supportVendor->id,[
            'name' => $supportVendorNew->name,
        ]);
        $response->assertRedirect('/manage/support-vendor');
        $updatedSupportVendor = \App\SupportVendor::find($supportVendor->id);
        $this->assertEquals($supportVendorNew->name,$updatedSupportVendor->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $supportVendor = factory(\App\SupportVendor::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/support-vendor/'.$supportVendor->id);
        $response->assertRedirect('/manage/support-vendor');
        $existingSupportVendor = \App\SupportVendor::find($supportVendor->id);
        $this->assertNull($existingSupportVendor);
    }

}
