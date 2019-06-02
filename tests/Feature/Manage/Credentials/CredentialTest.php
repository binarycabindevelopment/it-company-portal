<?php

namespace Tests\Feature\Manage\Credentials;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CredentialTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/credential');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credentials = factory(\App\Credential::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/credential');
        $response->assertStatus(200);
        foreach($credentials as $credential){
            $response->assertSeeText($credential->name);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/credential/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credential = factory(\App\Credential::class)->make();
        $response = $this->actingAs($auth)->post('/manage/credential',[
            'name' => $credential->name,
        ]);
        $response->assertRedirect('/manage/credential');
        $createdCredential = \App\Credential::where('name',$credential->name)->first();
        $this->assertNotNull($createdCredential);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credential = factory(\App\Credential::class)->create();
        $response = $this->actingAs($auth)->get('/manage/credential/'.$credential->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credential = factory(\App\Credential::class)->create();
        $response = $this->actingAs($auth)->get('/manage/credential/'.$credential->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credential = factory(\App\Credential::class)->create();
        $credentialNew = factory(\App\Credential::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/credential/'.$credential->id,[
            'name' => $credentialNew->name,
        ]);
        $response->assertRedirect($credential->path());
        $updatedCredential = \App\Credential::find($credential->id);
        $this->assertEquals($credentialNew->name,$updatedCredential->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $credential = factory(\App\Credential::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/credential/'.$credential->id);
        $response->assertRedirect('/manage/credential');
        $existingCredential = \App\Credential::find($credential->id);
        $this->assertNull($existingCredential);
    }

}
