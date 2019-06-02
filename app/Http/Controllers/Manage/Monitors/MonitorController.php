<?php

namespace App\Http\Controllers\Manage\Monitors;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;


class MonitorController extends BaseManageController
{
    protected $modelClass = \App\Monitor::class;
    protected $baseTitlePlural = 'Monitors';
    protected $baseTitleSingular = 'Monitor';
    protected $variableNamePlural = 'monitors';
    protected $variableNameSingular = 'monitor';
    protected $baseRoute = 'manage/monitor';
    protected $viewIndex = 'manage.monitor.index';
    protected $viewCreate='manage.monitor.create';
    protected $viewShow='manage.monitor.show';
    protected $viewEdit='manage.monitor.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }
}
