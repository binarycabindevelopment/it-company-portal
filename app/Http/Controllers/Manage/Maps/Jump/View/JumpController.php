<?php

namespace App\Http\Controllers\Manage\Maps\Jump\View;

use Illuminate\Http\Request;

class JumpController{

    public function store(Request $request){
        return redirect('/manage/map/'.$request->map_id.'/view');
    }

}