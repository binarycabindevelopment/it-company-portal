<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AppTestCase;

class ContactTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_types()
    {
        $contact = factory(\App\Contact::class)->create();
        $contactTypes = factory(\App\ContactType::class,2)->create([
            'contact_id' => $contact->id,
        ]);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->contactTypes->count());
        $this->assertEquals(2,count($contact->contact_types_input));
    }

    public function test_can_store_types()
    {
        $types = \App\Options\CustomerContactType::get();
        $contact = factory(\App\Contact::class)->create();
        $typeKeys = [];
        foreach($types as $typeKey => $typeValue){
            $typeKeys[] = $typeKey;
        }
        $data = [
            'contact_types_sync_input' => true,
            'contact_types_input' => [],
        ];
        $data['contact_types_input'][] = $typeKeys[0];
        $data['contact_types_input'][] = $typeKeys[1];
        $contact->update($data);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->contactTypes->count());
    }

    public function test_phones()
    {
        $contact = factory(\App\Contact::class)->create();
        $phones = factory(\App\Phone::class,2)->create([
            'phoneable_id' => $contact->id,
            'phoneable_type' => get_class($contact),
        ]);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->phones->count());
        $this->assertEquals(2,count($contact->phones_input));
    }

    public function test_can_store_phones()
    {
        $phones = factory(\App\Phone::class,2)->make();
        $contact = factory(\App\Contact::class)->create();
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
        $contact->update($data);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->phones->count());
    }

    public function test_addresses()
    {
        $contact = factory(\App\Contact::class)->create();
        $addresses = factory(\App\Address::class,2)->create([
            'addressable_id' => $contact->id,
            'addressable_type' => get_class($contact),
        ]);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->addresses->count());
        $this->assertEquals(2,count($contact->addresses_input));
    }

    public function test_can_store_addresses()
    {
        $addresses = factory(\App\Address::class,2)->make();
        $contact = factory(\App\Contact::class)->create();
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
        $contact->update($data);
        $contact = $contact->fresh();
        $this->assertEquals(2,$contact->addresses->count());
    }

}
