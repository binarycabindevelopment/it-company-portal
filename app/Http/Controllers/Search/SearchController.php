<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public function index(){
        return view('search.index');
    }

}
