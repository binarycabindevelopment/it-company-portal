<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 30;
        $currentModelsCount = \App\Ticket::all()->count();
        if($currentModelsCount < $requiredModels) {
            for ($i = 0; $i < $requiredModels; $i++) {
                $ticket = factory(\App\Ticket::class)->create();

                $contact = factory(\App\Contact::class)->create([
                    'contactable_id' => $ticket->id,
                    'contactable_type' => get_class($ticket),
                ]);
                $numberOfPhones = rand(0, 3);
                for ($phoneIndex = 0; $phoneIndex < $numberOfPhones; $phoneIndex++) {
                    $phone = factory(\App\Phone::class)->create([
                        'phoneable_id' => $contact->id,
                        'phoneable_type' => get_class($contact),
                    ]);
                }
                $numberOfAddresses = rand(0, 2);
                for ($addressIndex = 0; $addressIndex < $numberOfAddresses; $addressIndex++) {
                    $address = factory(\App\Address::class)->create([
                        'addressable_id' => $contact->id,
                        'addressable_type' => get_class($contact),
                    ]);
                }

                $linkedContact = factory(\App\LinkedContact::class)->create([
                    'contactable_id' => $ticket->id,
                    'contactable_type' => get_class($ticket),
                    'contact_id' => $contact->id
                ]);

                $numberOfEmployee = rand(0, 2);
                for ($employeeIndex = 0; $employeeIndex < $numberOfEmployee; $employeeIndex++) {

                    $linkedEmployees = factory(\App\LinkedEmployee::class)->create([
                        'employeeable_id' => $ticket->id,
                        'employeeable_type' => get_class($ticket),
                    ]);
                }
                $numberOfNotes = rand(0, 3);
                for ($noteIndex = 0; $noteIndex < $numberOfNotes; $noteIndex++) {
                    $linkedNotes = factory(\App\Note::class)->create([
                        'notable_id' => $ticket->id,
                        'notable_type' => get_class($ticket),
                    ]);
                }
            }
        }
    }
}
