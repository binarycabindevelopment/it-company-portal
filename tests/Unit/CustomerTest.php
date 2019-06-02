<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\AppTestCase;

class CustomerTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_phones()
    {
        $customer = factory(\App\Customer::class)->create();
        $phones = factory(\App\Phone::class,2)->create([
            'phoneable_id' => $customer->id,
            'phoneable_type' => get_class($customer),
        ]);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->phones->count());
        $this->assertEquals(2,count($customer->phones_input));
    }

    public function test_can_store_phones()
    {
        $phones = factory(\App\Phone::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $data = [
            'phones_sync_input' => true,
            'phones_input' => [],
        ];
        foreach($phones as $phone){
            $data['phones_input'][] = [
                'type' => $phone->type,
                'number' => $phone->number,
                'weight' => $phone->weight,
            ];
        }
        $customer->update($data);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->phones->count());
    }

    public function test_addresses()
    {
        $customer = factory(\App\Customer::class)->create();
        $addresses = factory(\App\Address::class,2)->create([
            'addressable_id' => $customer->id,
            'addressable_type' => get_class($customer),
        ]);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->addresses->count());
        $this->assertEquals(2,count($customer->addresses_input));
    }

    public function test_can_store_addresses()
    {
        $addresses = factory(\App\Address::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $data = [
            'addresses_sync_input' => true,
            'addresses_input' => [],
        ];
        foreach($addresses as $address){
            $data['addresses_input'][] = [
                'type' => $address->type,
                'address_1' => $address->address_1,
                'address_2' => $address->address_2,
                'city' => $address->city,
                'state' => $address->state,
                'zipcode' => $address->zipcode,
                'county' => $address->county,
                'country' => $address->country,
            ];
        }
        $customer->update($data);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->addresses->count());
    }

    public function test_links()
    {
        $customer = factory(\App\Customer::class)->create();
        $links = factory(\App\Link::class,2)->create([
            'linkable_id' => $customer->id,
            'linkable_type' => get_class($customer),
        ]);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->links->count());
        $this->assertEquals(2,count($customer->links_input));
    }

    public function test_can_store_links()
    {
        $links = factory(\App\Link::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $data = [
            'links_sync_input' => true,
            'links_input' => [],
        ];
        foreach($links as $link){
            $data['links_input'][] = [
                'weight' => $link->weight,
                'label' => $link->label,
                'url' => $link->url,
            ];
        }
        $customer->update($data);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->links->count());
    }

    public function test_contacts()
    {
        $customer = factory(\App\Customer::class)->create();
        $contacts = factory(\App\Contact::class,2)->create([
            'contactable_id' => $customer->id,
            'contactable_type' => get_class($customer),
        ]);
        $customer = $customer->fresh();
        $this->assertEquals(2,$customer->contacts->count());
    }

    public function test_logo()
    {
        $customer = factory(\App\Customer::class)->create();
        $logo = factory(\App\Logo::class,2)->create([
            'logoable_id' => $customer->id,
            'logoable_type' => get_class($customer),
        ]);
        $customer = $customer->fresh();
        $this->assertNotNull($customer->logo);
    }

    public function test_can_store_logo()
    {
        $logo = factory(\App\Logo::class)->make();
        $customer = factory(\App\Customer::class)->create();
        $data = [
            'logo_file' => UploadedFile::fake()->image($logo->file_name, 600, 600),
        ];
        $customer->update($data);
        $customer = $customer->fresh();
        $this->assertNotNull($customer->logo);
    }

}
