<?php

namespace Tests\Feature\Manage\Inventories;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends AppTestCase
{
    use RefreshDatabase;

    public function test_index(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $products = factory(\App\Product::class,2)->create();
        $response =  $this->actingAs($auth)->get('/manage/inventory');
        $response->assertStatus(200);
        foreach ($products as $product) {
        	$response->assertSee($product->name);
        }
    }
    public function test_create(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $product = factory(\App\Product::class)->create();
        $response =  $this->actingAs($auth)->get('/manage/inventory/create');
        $response->assertStatus(200);        
    }
    public function test_store(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $product = factory(\App\Product::class)->make();
        $response =  $this->actingAs($auth)->post('/manage/inventory',[
        	'name'=> $product->name,
        	'sku'=> $product->sku,
        	'category'=> $product->category,
        	'supplier'=> $product->supplier,
        	'brand'=> $product->brand,
        	'description'=> $product->description, 
        	'buy_price_cents'=> $product->buy_price_cents,
        	'wholesale_price_cents'=> $product->wholesale_price_cents, 
        	'retail_price_cents'=> $product->retail_price_cents,
        	'stock'=> $product->stock,       	
        ]);
        $response->assertRedirect('/manage/inventory');
        $createdProduct = \App\Product::where('name',$product->name)->first();
        $this->assertNotNull($createdProduct);

        $image = factory(\App\Image::class)->create([
            'file_name' => 'mock/1.jpg',
        ]);
        $response = $this->get($image->fileUrl());
        $response->assertStatus(200);
    }
    public function test_show(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $product = factory(\App\Product::class)->create();
        $response =  $this->actingAs($auth)->get('/manage/inventory/'.$product->id);
        $response->assertStatus(200);
    }
    public function test_edit(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $product = factory(\App\Product::class)->create();
        $response =  $this->actingAs($auth)->get('/manage/inventory/'.$product->id.'/edit');
        $response->assertStatus(200);
    }
    public function test_update(){
    	$auth = $this->newUser([
            'role' => 'admin'
        ]);
        $product = factory(\App\Product::class)->create();
        $newProduct = factory(\App\Product::class)->make();
        $response =  $this->actingAs($auth)->patch('/manage/inventory/'.$product->id,[
        	'name'=> $newProduct->name,
        	'sku'=> $newProduct->sku,
        	'category'=> $newProduct->category,
        	'supplier'=> $newProduct->supplier,
        	'brand'=> $newProduct->brand,
        	'description'=> $newProduct->description,
        	'buy_price_cents'=> $newProduct->buy_price_cents,
        	'wholesale_price_cents'=> $newProduct->wholesale_price_cents,
        	'retail_price_cents'=> $newProduct->retail_price_cents,
        	'stock'=> $newProduct->stock
        ]);
        $response->assertRedirect($product->path());
        $updatedProduct = \App\Product::find($product->id);
        $this->assertEquals($newProduct->name,$updatedProduct->name);

        $image = factory(\App\Image::class)->create([
            'file_name' => 'mock/1.jpg',
        ]);
        $response = $this->get($image->fileUrl());
        $response->assertStatus(200);
    }
    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $product = factory(\App\Product::class)->create();
        $response = $this->actingAs($auth)->delete('/manage/inventory/'.$product->id);
        $response->assertRedirect('/manage/inventory');
        $existingProduct = \App\Product::find($product->id);
        $this->assertNull($existingProduct);
    }
}
