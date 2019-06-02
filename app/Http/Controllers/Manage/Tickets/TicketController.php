<?php

namespace App\Http\Controllers\Manage\Tickets;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class TicketController extends BaseManageController
{
    protected $modelClass = \App\Ticket::class;
    protected $baseTitlePlural = 'Tickets';
    protected $baseTitleSingular = 'Ticket';
    protected $variableNamePlural = 'tickets';
    protected $variableNameSingular = 'ticket';
    protected $baseRoute = 'manage/ticket';
    protected $viewIndex = 'manage.ticket.index';
    protected $viewCreate='manage.ticket.create';
    protected $viewShow='manage.ticket.show';
    protected $viewEdit='manage.ticket.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }
}
