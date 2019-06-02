<?php

namespace Tests\Feature\Manage\Maps;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MapTest extends AppTestCase
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
        $maps = factory(\App\Map::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/map');
        $response->assertStatus(200);
        foreach($maps as $map){
            $response->assertSee($map->name);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/map/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->make();
        $response = $this->actingAs($auth)->post('/manage/map',[
            'name' => $map->name,
        ]);
        $response->assertRedirect('/manage/map');
        $createdMap = \App\Map::where('name',$map->name)->first();
        $this->assertNotNull($createdMap);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->create();
        $response = $this->actingAs($auth)->get('/manage/map/'.$map->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->create();
        $response = $this->actingAs($auth)->get('/manage/map/'.$map->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->create();
        $mapNew = factory(\App\Map::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/map/'.$map->id,[
            'name' => $mapNew->name,
        ]);
        $response->assertRedirect($map->path());
        $updatedMap = \App\Map::find($map->id);
        $this->assertEquals($mapNew->name,$updatedMap->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $map = factory(\App\Map::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/map/'.$map->id);
        $response->assertRedirect('/manage/map');
        $existingMap = \App\Map::find($map->id);
        $this->assertNull($existingMap);
    }

}
