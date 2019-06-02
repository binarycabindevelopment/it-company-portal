<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(){
        $totalOpenTickets = \App\Ticket::where('status','=','Open')->count();
        $totalClosedTickets = \App\Ticket::where('status','=','Closed')->count();
        $totalCustomerAccounts = \App\Customer::where('id','>',0)->count();
        $totalEmployees = \App\Employee::where('id','>',0)->count();
        $recentOpenTickets = \App\Ticket::where('status','=','Open')->latest()->limit(3)->get();
        $recentCustomers = \App\Customer::where('id','>',0)->latest()->limit(3)->get();
        return view('dashboard.index',[
            'totalOpenTickets' => $totalOpenTickets,
            'totalClosedTickets' => $totalClosedTickets,
            'totalCustomerAccounts' => $totalCustomerAccounts,
            'totalEmployees' => $totalEmployees,
            'recentOpenTickets' => $recentOpenTickets,
            'recentCustomers' => $recentCustomers,
        ]);
    }

}
