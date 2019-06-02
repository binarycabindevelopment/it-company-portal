<?php

namespace App\Http\Controllers\Manage\Maps;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;


class MapController extends BaseManageController
{
    protected $modelClass = \App\Map::class;
    protected $baseTitlePlural = 'Maps';
    protected $baseTitleSingular = 'Map';
    protected $variableNamePlural = 'maps';
    protected $variableNameSingular = 'map';
    protected $baseRoute = 'manage/map';
    protected $viewIndex = 'manage.map.index';
    protected $viewCreate='manage.map.create';
    protected $viewShow='manage.map.show';
    protected $viewEdit='manage.map.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }
}
