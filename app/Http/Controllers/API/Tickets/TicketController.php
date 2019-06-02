<?php

namespace App\Http\Controllers\API\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function index(Request $request){
        $ticketsQuery = \App\Ticket::query();
        $ticketsQuery->filter($request->all());
        $tickets = $ticketsQuery->get();
        $response = new \stdClass();
        $response->success = true;
        $response->data = $tickets;
        return response()->json($response);
    }

}
