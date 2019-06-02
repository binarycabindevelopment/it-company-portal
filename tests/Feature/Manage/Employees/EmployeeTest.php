<?php

namespace Tests\Feature\Manage\Employees;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/employee');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employees = factory(\App\Employee::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/employee');
        $response->assertStatus(200);
        foreach($employees as $employee){
            $response->assertSee($employee->key);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/employee/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employee = factory(\App\Employee::class)->make();
        $response = $this->actingAs($auth)->post('/manage/employee',[
            'key' => $employee->key,
        ]);
        $response->assertRedirect('/manage/employee');
        $createdEmployee = \App\Employee::where('key',$employee->key)->first();
        $this->assertNotNull($createdEmployee);
        $this->assertNotNull($createdEmployee->uuid);
    }

    public function test_show(){
        $this->withoutExceptionHandling();
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employee = factory(\App\Employee::class)->create();
        $response = $this->actingAs($auth)->get('/manage/employee/'.$employee->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employee = factory(\App\Employee::class)->create();
        $response = $this->actingAs($auth)->get('/manage/employee/'.$employee->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employee = factory(\App\Employee::class)->create();
        $employeeNew = factory(\App\Employee::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/employee/'.$employee->id,[
            'key' => $employeeNew->key,
        ]);
        $response->assertRedirect($employee->path());
        $updatedEmployee = \App\Employee::find($employee->id);
        $this->assertEquals($employeeNew->key,$updatedEmployee->key);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $employee = factory(\App\Employee::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/employee/'.$employee->id);
        $response->assertRedirect('/manage/employee');
        $existingEmployee = \App\Employee::find($employee->id);
        $this->assertNull($existingEmployee);
    }

}
