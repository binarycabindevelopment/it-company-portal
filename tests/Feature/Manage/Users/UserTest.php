<?php

namespace Tests\Feature\Manage\Users;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/user');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $users = factory(\App\User::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/user');
        $response->assertStatus(200);
        foreach($users as $user){
            $response->assertSee($user->email);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/user/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $password = str_random();
        $role = 'customer';
        $user = factory(\App\User::class)->make();
        $response = $this->actingAs($auth)->post('/manage/user',[
            'email' => $user->email,
            'password' => $password,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'role' => $role,
        ]);
        $response->assertRedirect('/manage/user');
        $authAttempt = \Auth::attempt([
            'email' => $user->email,
            'password' => $password,
        ]);
        $this->assertTrue($authAttempt);
    }
    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $user = factory(\App\User::class)->create();
        $response = $this->actingAs($auth)->get('/manage/user/'.$user->id.'/edit');
        $response->assertStatus(200);
    }


    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $password = str_random();
        $role = 'customer';
        $user = factory(\App\User::class)->create(['role'=>'customer']);
        $userNew = factory(\App\User::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/user/'.$user->id,[
            'email' => $userNew->email,
            'password' => $password,
            'first_name' => $userNew->first_name,
            'last_name' => $userNew->last_name,
            'role' => $role,
        ]);
        $response->assertRedirect('/manage/user');
        $authAttempt = \Auth::attempt([
            'email' => $userNew->email,
            'password' => $password,
        ]);
        $this->assertTrue($authAttempt);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $user = factory(\App\User::class)->create(['role'=>'customer']);
        $response = $this->actingAs($auth)->delete('/manage/user/'.$user->id);
        $response->assertRedirect('/manage/user');
        $existingUser = \App\User::find($user->id);
        $this->assertNull($existingUser);
    }

}
