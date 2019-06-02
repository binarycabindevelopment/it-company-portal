<?php

namespace Tests\Feature\Manage\Assets;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $response = $this->actingAs($auth)->get('/manage/asset');
        $response->assertRedirect('/account');
    }

    public function test_index(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $assets = factory(\App\Asset::class,2)->create();
        $response = $this->actingAs($auth)->get('/manage/asset');
        $response->assertStatus(200);
        foreach($assets as $asset){
            $response->assertSee($asset->name);
        }
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $response = $this->actingAs($auth)->get('/manage/asset/create');
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->make();
        $response = $this->actingAs($auth)->post('/manage/asset',[
            'name' => $asset->name,
        ]);
        $response->assertRedirect('/manage/asset');
        $createdAsset = \App\Asset::where('name',$asset->name)->first();
        $this->assertNotNull($createdAsset);
    }

    public function test_show(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $response = $this->actingAs($auth)->get('/manage/asset/'.$asset->id);
        $response->assertStatus(200);
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $response = $this->actingAs($auth)->get('/manage/asset/'.$asset->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $assetNew = factory(\App\Asset::class)->make();
        $response = $this->actingAs($auth)->patch('/manage/asset/'.$asset->id,[
            'name' => $assetNew->name,
        ]);
        $response->assertRedirect($asset->path());
        $updatedAsset = \App\Asset::find($asset->id);
        $this->assertEquals($assetNew->name,$updatedAsset->name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/asset/'.$asset->id);
        $response->assertRedirect('/manage/asset');
        $existingAsset = \App\Asset::find($asset->id);
        $this->assertNull($existingAsset);
    }

}
