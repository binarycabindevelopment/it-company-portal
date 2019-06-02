<?php

namespace App\Http\Controllers\Manage\Customers;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class CustomerController extends BaseManageController
{

    protected $modelClass = \App\Customer::class;
    protected $baseTitlePlural = 'Customers';
    protected $baseTitleSingular = 'Customer';
    protected $variableNamePlural = 'customers';
    protected $variableNameSingular = 'customer';
    protected $baseRoute = 'manage/customer';
    protected $viewIndex = 'manage.customer.index';
    protected $viewCreate='manage.customer.create';
    protected $viewShow='manage.customer.show';
    protected $viewEdit='manage.customer.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }

}
