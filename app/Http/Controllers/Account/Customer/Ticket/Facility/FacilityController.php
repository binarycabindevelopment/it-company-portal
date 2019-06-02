<?php

namespace App\Http\Controllers\Account\Customer\Ticket\Facility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class FacilityController extends Controller
{
    protected  $baseRoute = 'account/customer/ticket/';


    public function create($ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        return view('account.customer.ticket.facility.create',['ticket'=>$ticket,'baseRoute'=>$this->baseRoute]);
    }

    public function store(Request $request,$ticketId){

        $ticket = \App\Ticket::findOrFail($ticketId);
        //dd($ticket);
        $ticketData = $request->all();
//        dd($ticketData);
//
//
//        $ticketData['ticketable_type'] = get_class($ticket);
//        $ticketData['ticketable_id'] = $ticket->id;

        $linkedFacility = $ticket->linkFacility($ticket, $ticketData);
        return redirect('account/customer/ticket/'.$ticket->id)->withSuccess('Saved');
    }
}
