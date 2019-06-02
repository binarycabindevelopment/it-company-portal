<?php

namespace App\Http\Controllers\Manage\Tickets\Employees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create($ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        return view('manage.ticket.employee.create',['ticket'=>$ticket]);
    }

    public function store(Request $request, $ticketId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $linkedEmployeeData = $request->all();
        $linkedEmployeeData['employeeable_type'] = get_class($ticket);
        $linkedEmployeeData['employeeable_id'] = $ticket->id;
        $linked = \App\LinkedEmployee::create($linkedEmployeeData);
        return redirect($ticket->path())->withSuccess('Saved');
    }

    public function destroy($ticketId, $employeeId){
        $ticket = \App\Ticket::findOrFail($ticketId);
        $linkedEmployee = \App\LinkedEmployee::findOrFail($employeeId);
        $linkedEmployee->delete();
        return redirect($ticket->path())->withSuccess('Deleted');
    }


}
