<?php

namespace Tests\Feature\Uploads\Logos;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UploadTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_show(){
        $logo = factory(\App\Logo::class)->create([
            'file_name' => 'mock/1.jpg',
        ]);
        $response = $this->get($logo->fileUrl());
        $response->assertStatus(200);
    }

}
