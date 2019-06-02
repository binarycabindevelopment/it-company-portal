<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $requiredModels = 30;
        $currentModelsCount = \App\Customer::all()->count();
        if ($currentModelsCount < $requiredModels) {
            for ($i = 0; $i < $requiredModels; $i++) {
                $customer = factory(\App\Customer::class)->create();
                $numberOfContacts = rand(0, 10);
                for ($contactIndex = 0; $contactIndex < $numberOfContacts; $contactIndex++) {
                    $contact = factory(\App\Contact::class)->create([
                        'contactable_id' => $customer->id,
                        'contactable_type' => get_class($customer),
                    ]);
                    $numberOfContactTypes = rand(1, 1);
                    for ($contactTypeIndex = 0; $contactTypeIndex < $numberOfContactTypes; $contactTypeIndex++) {
                        $contactType = factory(\App\ContactType::class)->create([
                            'contact_id' => $contact->id,
                        ]);
                    }
                }
                $numberOfFacilities = rand(0, 10);
                for ($facilityIndex = 0; $facilityIndex < $numberOfFacilities; $facilityIndex++) {
                    $facility = factory(\App\Facility::class)->create([
                        'facilityable_id' => $customer->id,
                        'facilityable_type' => get_class($customer),
                    ]);
                    $numberOfLinks = rand(0, 2);
                    for ($linkIndex = 0; $linkIndex < $numberOfLinks; $linkIndex++) {
                        $link = factory(\App\Link::class)->create([
                            'linkable_id' => $facility->id,
                            'linkable_type' => get_class($facility),
                        ]);
                    }
                    $numberOfPhones = rand(0, 3);
                    for ($phoneIndex = 0; $phoneIndex < $numberOfPhones; $phoneIndex++) {
                        $phone = factory(\App\Phone::class)->create([
                            'phoneable_id' => $facility->id,
                            'phoneable_type' => get_class($facility),
                        ]);
                    }
                    $numberOfAddresses = rand(0, 2);
                    for ($addressIndex = 0; $addressIndex < $numberOfAddresses; $addressIndex++) {
                        $address = factory(\App\Address::class)->create([
                            'addressable_id' => $facility->id,
                            'addressable_type' => get_class($facility),
                        ]);
                    }
                    $numberOfMaps = rand(0, 4);
                    for ($mapsIndex = 0; $mapsIndex < $numberOfMaps; $mapsIndex++) {
                        $map = factory(\App\Map::class)->create([
                            'mappable_id' => $facility->id,
                            'mappable_type' => get_class($facility),
                        ]);
                        $chanceOfImage = rand(0, 100);
                        if ($chanceOfImage < 90) {
                            $mockImageFiles = \Storage::files('uploads/image/mock/map');
                            $mockImageFile = $mockImageFiles[array_rand($mockImageFiles)];
                            $mockImageFile = str_replace('uploads/image/', '', $mockImageFile);
                            $image = factory(\App\Image::class)->create([
                                'imageable_type' => get_class($map),
                                'imageable_id' => $map->id,
                                'file_name' => $mockImageFile,
                            ]);
                        }
                    }
                    $chanceOfImage = rand(0, 100);
                    if ($chanceOfImage < 80) {
                        $mockImageFiles = \Storage::files('uploads/image/mock');
                        $mockImageFile = $mockImageFiles[array_rand($mockImageFiles)];
                        $mockImageFile = str_replace('uploads/image/', '', $mockImageFile);
                        $image = factory(\App\Image::class)->create([
                            'imageable_type' => get_class($facility),
                            'imageable_id' => $facility->id,
                            'file_name' => $mockImageFile,
                        ]);
                    }
                    foreach ($customer->contacts as $contact) {
                        $chanceOfAddingContact = rand(0, 100);
                        if ($chanceOfAddingContact < 80) {
                            $linkedContact = factory(\App\LinkedContact::class)->create([
                                'contactable_id' => $facility->id,
                                'contactable_type' => get_class($facility),
                                'contact_id' => $contact->id,
                            ]);
                            $chanceOfAddingUser = rand(0, 100);
                            if($chanceOfAddingUser < 80){
                                $user = factory(\App\User::class)->create();
                                $linkedUser = factory(\App\LinkedUser::class)->create([
                                    'userable_id' => $contact->id,
                                    'userable_type' => get_class($contact),
                                    'user_id' => $user->id,
                                ]);
                            }
                        }
                    }
                }
                $numberOfLinks = rand(0, 2);
                for ($linkIndex = 0; $linkIndex < $numberOfLinks; $linkIndex++) {
                    $link = factory(\App\Link::class)->create([
                        'linkable_id' => $customer->id,
                        'linkable_type' => get_class($customer),
                    ]);
                }
                $numberOfPhones = rand(0, 3);
                for ($phoneIndex = 0; $phoneIndex < $numberOfPhones; $phoneIndex++) {
                    $phone = factory(\App\Phone::class)->create([
                        'phoneable_id' => $customer->id,
                        'phoneable_type' => get_class($customer),
                    ]);
                }
                $numberOfAddresses = rand(0, 2);
                for ($addressIndex = 0; $addressIndex < $numberOfAddresses; $addressIndex++) {
                    $address = factory(\App\Address::class)->create([
                        'addressable_id' => $customer->id,
                        'addressable_type' => get_class($customer),
                    ]);
                }
                $chanceOfLogo = rand(0, 100);
                if ($chanceOfLogo < 80) {
                    $mockImageFiles = \Storage::files('uploads/logo/mock');
                    $mockImageFile = $mockImageFiles[array_rand($mockImageFiles)];
                    $mockImageFile = str_replace('uploads/logo/', '', $mockImageFile);
                    $logo = factory(\App\Logo::class)->create([
                        'logoable_type' => get_class($customer),
                        'logoable_id' => $customer->id,
                        'file_name' => $mockImageFile,
                    ]);
                }
            }

        }
    }
}
