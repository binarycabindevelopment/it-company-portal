<?php

namespace App\Http\Controllers\Account\Customer\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class TicketController extends Controller {

    protected $baseRoute = 'account/customer/ticket/';
    protected $paginationPer = 25;

  public function index(Request $request)
  {
      $user_id = Auth::user()->id;
      $tickets = \App\User::find($user_id)->customer->tickets;

      if ($request->ticketable_id){
          $expectedFacilityId = $request->ticketable_id;
          $tickets = $tickets->filter(function ($value, $key) use($expectedFacilityId) {
              $hasThisFacility = false;
              foreach($value->facilities as $facility){
                  if($facility->id == $expectedFacilityId){
                      $hasThisFacility = true;
                  }
              }
              if($hasThisFacility){
                  return $value;
              }
          });
      }

      if($request->global){
          $exceptedGlobal = $request->global;
          $tickets = $tickets->filter(function($value,$key) use($exceptedGlobal){
               if($value->status == $exceptedGlobal || $value->type == $exceptedGlobal ||
                   $value->title == $exceptedGlobal || $value->priority == $exceptedGlobal){
                  return $value;
               }
          });
      }
      $paginatedData = $this->paginate($tickets, $perPage = $this->paginationPer, $page = null, $options = []);
      $paginatedData->withPath('ticket');

      return view('account.customer.ticket.index',[
            'tickets'=>$paginatedData,
      ]);

  }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
  public function create(){
      $user_id = Auth::user()->id;
      $customerId = \App\User::find($user_id)->customer->id;
      $customer = \App\Customer::findOrFail($customerId);

      return view('account.customer.ticket.create',[
             'customer'=>$customer
      ]);
  }
  public function store(Request $request){
      $user_id = Auth::user()->id;
      $user = \App\User::where('id',$user_id)->first();
      $customer= $user->customer;

      $ticketData = $request->all();
      $ticketData['ticketable_type'] = get_class($customer);
      $ticketData['ticketable_id'] = $customer->id;
      $ticket = \App\Ticket::create($ticketData);
     return redirect('account/customer/ticket/')->withSuccess('Saved');
  }

  public function edit($ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);

        return view('account.customer.ticket.edit',['ticket'=>$ticket,'baseRoute'=>$this->baseRoute]);
    }
    public function  show($ticketId){
        $user_id = Auth::user()->id;
        $user = \App\User::where('id',$user_id)->first();
        $ticket = \App\Ticket::findOrFail($ticketId);

        return view('account.customer.ticket.show',['ticket'=>$ticket,'baseRoute'=>$this->baseRoute,'customer'=>$ticket->ticketable]);
    }

    public function update(Request $request, $ticketId){

        $ticket = \App\Ticket::findOrFail($ticketId);
        $ticket->update($request->all());

        return redirect($this->baseRoute.$ticketId)->withSuccess('Saved');
    }

    public function linkedFacilities($createData){
        static::linkFacility($createData);
    }

}
