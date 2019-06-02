<?php

namespace App\Http\Controllers\Account\Clock;

use App\Http\Controllers\Controller;

class ClockController extends Controller
{
    public function store(){
        \Auth::user()->clockIn();
        return redirect()->back()->withSuccess('Clocked In');
    }

    public function destroy(){
        \Auth::user()->clockOut();
        return redirect()->back()->withSuccess('Clocked Out');
    }

}
