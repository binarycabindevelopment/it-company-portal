<?php

namespace Tests\Feature\Manage\Customers\Facilities\Contacts;

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
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $response = $this->actingAs($auth)->get($facility->path('contact/create'));
        $response->assertRedirect('/account');
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $response = $this->actingAs($auth)->get($facility->path('contact/create'));
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $contact = factory(\App\Contact::class)->make();
        $response = $this->actingAs($auth)->post($facility->path('contact'),[
            'type' => $contact->type,
            'title' => $contact->title,
            'first_name' => $contact->first_name,
            'middle_name' => $contact->middle_name,
            'last_name' => $contact->last_name,
            'email' => $contact->email,
            'job_title' => $contact->job_title,
        ]);
        $createdContact = \App\Contact::where('last_name',$contact->last_name)->first();
        $response->assertRedirect($facility->path());
        $this->assertNotNull($createdContact);
        $facility = $facility->fresh();
        $this->assertEquals(1, $facility->contacts->count());
        $this->assertEquals(1, $customer->contacts->count());
    }

    public function test_store_contact_id(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_id' => $customer->id,
            'facilityable_type' => get_class($customer),
        ]);
        $contact = factory(\App\Contact::class)->create([
            'contactable_id' => $customer->id,
            'contactable_type' => get_class($customer),
        ]);
        $response = $this->actingAs($auth)->post($facility->path('contact'),[
            'contact_ids' => [$contact->id],
        ]);
        $response->assertRedirect($facility->path());
        $facility = $facility->fresh();
        $this->assertEquals(1, $facility->contacts->count());
        $this->assertEquals(1, $customer->contacts->count());
    }

}
