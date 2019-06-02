<?php

namespace App\Http\Controllers\Manage\Employees;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class EmployeeController extends BaseManageController
{

    protected $modelClass = \App\Employee::class;
    protected $baseTitlePlural = 'Employees';
    protected $baseTitleSingular = 'Employee';
    protected $variableNamePlural = 'employees';
    protected $variableNameSingular = 'employee';
    protected $baseRoute = 'manage/employee';
    protected $viewIndex = 'manage.employee.index';
    protected $viewCreate='manage.employee.create';
    protected $viewShow='manage.employee.show';
    protected $viewEdit='manage.employee.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }

}
