<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AppTestCase;
use Illuminate\Http\UploadedFile;

class FacilityTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_phones()
    {
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $phones = factory(\App\Phone::class,2)->create([
            'phoneable_id' => $facility->id,
            'phoneable_type' => get_class($facility),
        ]);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->phones->count());
        $this->assertEquals(2,count($facility->phones_input));
    }

    public function test_can_store_phones()
    {
        $phones = factory(\App\Phone::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
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
        $facility->update($data);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->phones->count());
    }

    public function test_addresses()
    {
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $addresses = factory(\App\Address::class,2)->create([
            'addressable_id' => $facility->id,
            'addressable_type' => get_class($facility),
        ]);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->addresses->count());
        $this->assertEquals(2,count($facility->addresses_input));
    }

    public function test_can_store_addresses()
    {
        $addresses = factory(\App\Address::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
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
        $facility->update($data);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->addresses->count());
    }

    public function test_links()
    {
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $links = factory(\App\Link::class,2)->create([
            'linkable_id' => $facility->id,
            'linkable_type' => get_class($facility),
        ]);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->links->count());
        $this->assertEquals(2,count($facility->links_input));
    }

    public function test_can_store_links()
    {
        $links = factory(\App\Link::class,2)->make();
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
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
        $facility->update($data);
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->links->count());
    }

    public function test_contacts(){
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $contacts = factory(\App\Contact::class,2)->create([
            'contactable_id' => $customer->id,
            'contactable_type' => get_class($customer),
        ]);
        foreach($contacts as $contact){
            factory(\App\LinkedContact::class)->create([
                'contactable_id' => $facility->id,
                'contactable_type' => get_class($facility),
                'contact_id' => $contact->id,
            ]);
        }
        $facility = $facility->fresh();
        $this->assertEquals(2,$facility->contacts->count());
    }

    public function test_image()
    {
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $image = factory(\App\Image::class,2)->create([
            'imageable_id' => $facility->id,
            'imageable_type' => get_class($facility),
        ]);
        $facility = $facility->fresh();
        $this->assertNotNull($facility->image);
    }

    public function test_can_store_image()
    {
        $image = factory(\App\Image::class)->make();
        $customer = factory(\App\Customer::class)->create();
        $facility = factory(\App\Facility::class)->create([
            'facilityable_type' => get_class($customer),
            'facilityable_id' => $customer->id,
        ]);
        $data = [
            'image_file' => UploadedFile::fake()->image($image->file_name, 600, 600),
        ];
        $facility->update($data);
        $facility = $facility->fresh();
        $this->assertNotNull($facility->image);
    }

}
