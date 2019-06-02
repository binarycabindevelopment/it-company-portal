<?php

namespace Tests\Feature\Account\Customer\Ticket;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends AppTestCase
{
    use RefreshDatabase;

    public function test_index(){
        $this->withoutExceptionHandling();
        $auth = $this->newUser([
            'role' => 'customer',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);
        $tickets = factory(\App\Ticket::class,2)->create([
            'ticketable_type' => get_class($customer),
            'ticketable_id' => $customer->id,
        ]);
        $response = $this->actingAs($auth)->get('/account/customer/ticket');
        $response->assertStatus(200);
        foreach($tickets as $ticket){
            $response->assertSee($ticket->status);
        }
    }

     public function test_create(){
        $auth = $this->newUser([
            'role' => 'customer',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);
        $response = $this->actingAs($auth)->get('/account/customer/ticket/create');
        $response->assertStatus(200);
    }

    public function test_store(){
    	$auth = $this->newUser([
            'role' => 'customer',
        ]);

    	$customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);

        $ticket = factory(\App\Ticket::class)->make();
        $response = $this->actingAs($auth)->post('/account/customer/ticket',[
            'title' => $ticket->title,
        ]);
        $response->assertRedirect('/account/customer/ticket');
        $createdTicket = \App\Ticket::where('title',$ticket->title)->first();
        $this->assertNotNull($createdTicket);
    }

     public function test_show(){
        $auth = $this->newUser([
            'role' => 'customer',
        ]);

        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);

        $ticket = factory(\App\Ticket::class)->create();
        $response = $this->actingAs($auth)->get('/account/customer/ticket/'.$ticket->id);
        $response->assertStatus(200);
    }

     public function test_edit(){
        $auth = $this->newUser([
            'role' => 'customer',
        ]);
        
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);

        $ticket = factory(\App\Ticket::class)->create();
        $response = $this->actingAs($auth)->get('/account/customer/ticket/'.$ticket->id.'/edit');
        $response->assertStatus(200);
    }

    public function test_update(){
        $auth = $this->newUser([
            'role' => 'customer',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);

        $ticket = factory(\App\Ticket::class)->create();
        $ticketNew = factory(\App\Ticket::class)->make();
        $response = $this->actingAs($auth)->patch('/account/customer/ticket/'.$ticket->id,[
            'title' => $ticketNew->title,
        ]);
        $response->assertRedirect('/account/customer/ticket/'.$ticket->id);
        $updatedTicket = \App\Ticket::find($ticket->id);
        $this->assertEquals($ticketNew->title,$updatedTicket->title);
    }

    public function test_delete_not_allowed(){
        $auth = $this->newUser([
            'role' => 'customer',
        ]);
        $customer = factory(\App\Customer::class)->create();
        $contact = factory(\App\Contact::class)->create([
            'contactable_type' => get_class($customer),
            'contactable_id' => $customer->id,
        ]);
        $contact->linkUser($auth);

        $ticket = factory(\App\Ticket::class)->create();
        $response = $this->actingAs($auth)->delete('/account/customer/ticket/'.$ticket->id);
        $response->assertStatus(405);
    }

}
