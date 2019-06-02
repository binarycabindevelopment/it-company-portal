<?php

namespace App\Http\Controllers\Manage\Tickets\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create($ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        return view('manage.ticket.contact.create',['ticket'=>$ticket]);
    }

    public function store(Request $request, $ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        if(!empty($request->contact_ids)){
            foreach($request->contact_ids as $contactId){
                \App\LinkedContact::create([
                    'contactable_id' => $ticket->id,
                    'contactable_type' => get_class($ticket),
                ]);
            }
        }else{
            $contactData = $request->all();
            $contactData['contactable_type'] = get_class($ticket->ticketable->facilityable);
            $contactData['contactable_id'] = $ticket->ticketable->facilityable->id;
            $contact = \App\Contact::create($contactData);
            \App\LinkedContact::create([
                'contactable_id' => $ticket->id,
                'contactable_type' => get_class($ticket),
                'contact_id' => $contact->id,
            ]);
        }
        return redirect($ticket->path())->withSuccess('Saved');
    }

    public function destroy(Request $request, $ticketId, $contactId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $linkedContact = $ticket->linkedContacts()->where('contact_id',$contactId)->first();
        $linkedContact->delete();
        return redirect($ticket->path())->withSuccess('Contact removed');
    }


}
