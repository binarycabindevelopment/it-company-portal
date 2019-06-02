<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 30;
        $currentModelsCount = \App\Employee::all()->count();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $employee = factory(\App\Employee::class)->create();
                $contact = factory(\App\Contact::class)->create([
                    'contactable_id' => $employee->id,
                    'contactable_type' => get_class($employee),
                ]);
                $user = factory(\App\User::class)->create();
                $employee->linkUser($user);
                $numberOfPhones = rand(0,3);
                for($phoneIndex=0;$phoneIndex<$numberOfPhones;$phoneIndex++){
                    $phone = factory(\App\Phone::class)->create([
                        'phoneable_id' => $contact->id,
                        'phoneable_type' => get_class($contact),
                    ]);
                }
                $numberOfAddresses = rand(0,2);
                for($addressIndex=0;$addressIndex<$numberOfAddresses;$addressIndex++){
                    $address = factory(\App\Address::class)->create([
                        'addressable_id' => $contact->id,
                        'addressable_type' => get_class($contact),
                    ]);
                }
            }

        }
    }
}
