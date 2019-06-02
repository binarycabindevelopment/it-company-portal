<?php

namespace App\Http\Controllers\Manage\Vehicles;
use App\Http\Controllers\Manage\BaseManageController;

use Illuminate\Http\Request;

class VehicleController extends BaseManageController
{
    protected $modelClass = \App\Vehicle::class;
    protected $baseTitlePlural = 'Vehicles';
    protected $baseTitleSingular = 'Vehicle';
    protected $variableNamePlural = 'vehicles';
    protected $variableNameSingular = 'vehicle';
    protected $baseRoute = 'manage/vehicle';
    protected $viewIndex = 'manage.vehicle.index';
    protected $viewCreate='manage.vehicle.create';
    protected $viewShow='manage.vehicle.show';
    protected $viewEdit='manage.vehicle.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }
}
