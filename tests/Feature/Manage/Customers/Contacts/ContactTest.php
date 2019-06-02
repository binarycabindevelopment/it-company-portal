<?php

namespace Tests\Feature\Manage\Customers\Contacts;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get($customer->path('contact/create'));
        $response->assertRedirect('/account');
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $response = $this->actingAs($auth)->get($customer->path('contact/create'));
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->make();
        $response = $this->actingAs($auth)->post($customer->path('contact'),[
            'type' => $contact->type,
            'title' => $contact->title,
            'first_name' => $contact->first_name,
            'middle_name' => $contact->middle_name,
            'last_name' => $contact->last_name,
            'email' => $contact->email,
            'job_title' => $contact->job_title,
        ]);
        $createdContact = \App\Contact::where('last_name',$contact->last_name)->first();
        $response->assertRedirect($customer->path());
        $this->assertNotNull($createdContact);
        $customer = $customer->fresh();
        $this->assertEquals(1, $customer->contacts->count());
    }

    public function test_edit(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->get($customer->path('/contact/'.$contact->id.'/edit'));
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contactNew = factory(\App\Contact::class)->make();
        $response = $this->actingAs($auth)->patch($customer->path('contact/'.$contact->id),[
            'last_name' => $contactNew->last_name,
        ]);
        $response->assertRedirect($customer->path());
        $updatedContact = \App\Contact::find($contact->id);
        $this->assertEquals($contactNew->last_name,$updatedContact->last_name);
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->delete($customer->path('contact/'.$contact->id));
        $response->assertRedirect($customer->path());
        $existingContact = \App\Contact::find($contact->id);
        $this->assertNull($existingContact);
    }

}
