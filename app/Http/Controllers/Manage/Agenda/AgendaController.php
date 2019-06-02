<?php

namespace App\Http\Controllers\Manage\Agenda;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{

    public function index(){
        return view('manage.agenda.index');
    }

}
