<?php

namespace App\Http\Controllers\Manage\Monitors\Pings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PingController extends Controller
{

    public function store(Request $request, $monitorId){
        $monitor = \App\Monitor::findOrFail($monitorId);
        $monitor->createPing();
        return redirect($monitor->path())->withSuccess('Ping Sent');
    }

}
