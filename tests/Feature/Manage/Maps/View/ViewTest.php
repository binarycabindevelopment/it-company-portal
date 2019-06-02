<?php

namespace Tests\Feature\Manage\Maps\View;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/map');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->create();
        $response = $this->actingAs($auth)->get('/manage/map/'.$map->id.'/view');
        $response->assertStatus(200);
    }

}
