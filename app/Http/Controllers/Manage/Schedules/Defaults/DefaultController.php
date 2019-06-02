<?php

namespace App\Http\Controllers\Manage\Schedules\Defaults;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{

    protected $baseRoute = 'manage/schedule';

    public function show()
    {
        $schedule = \App\Schedule::createOrGetDefault();
        return view('manage.schedule.default.show',['schedule'=>$schedule]);
    }

    public function edit()
    {
        $schedule = \App\Schedule::createOrGetDefault();
        return view('manage.schedule.default.edit',['schedule'=>$schedule,'baseRoute'=>$this->baseRoute]);
    }

    public function update(Request $request)
    {
        $schedule = \App\Schedule::createOrGetDefault();
        $schedule->update($request->all());
        return redirect($this->baseRoute.'/default')->withSuccess('Saved!');
    }

}
