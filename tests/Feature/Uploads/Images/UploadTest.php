<?php

namespace Tests\Feature\Uploads\Images;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_show(){
        $image = factory(\App\Image::class)->create([
            'file_name' => 'mock/1.jpg',
        ]);
        $response = $this->get($image->fileUrl());
        $response->assertStatus(200);
    }

}
