<?php

namespace Tests\Unit;

use Tests\AppTestCase;

class UserTest extends AppTestCase
{

    public function test_hash_password_in_attributes_removes_blank_password()
    {
        $newAttributes = \App\User::attributesHashPasswordIfExists([
            'foo' => 'bar',
            'password' => '',
        ]);
        $this->assertEquals([
            'foo' => 'bar',
        ],$newAttributes);
    }

    public function test_hash_password_by_passing_attributes()
    {
        $password = 'secret';
        $newAttributes = \App\User::attributesHashPasswordIfExists([
            'foo' => 'bar',
            'password' => $password,
        ]);
        $this->assertTrue(\Hash::check($password, $newAttributes['password']));
    }

    public function test_role_is(){
        $user = factory(\App\User::class)->make([
            'role' => 'authenticated',
        ]);
        $this->assertTrue($user->roleIs('authenticated'));
        $this->assertFalse($user->roleIs('customer'));
    }

    public function test_role_in(){
        $user = factory(\App\User::class)->make([
            'role' => 'authenticated',
        ]);
        $this->assertTrue($user->roleIn(['authenticated','customer']));
        $this->assertFalse($user->roleIn(['customer']));
    }

    public function test_is_admin(){
        $user = factory(\App\User::class)->make([
            'role' => 'admin',
        ]);
        $user2 = factory(\App\User::class)->make([
            'role' => 'employee',
        ]);
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user2->isAdmin());
    }

}
