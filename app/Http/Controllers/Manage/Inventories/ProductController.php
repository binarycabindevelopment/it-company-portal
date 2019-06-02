<?php

namespace App\Http\Controllers\Manage\Inventories;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class ProductController extends BaseManageController
{
    protected $modelClass = \App\Product::class;
    protected $baseTitlePlural = 'Products';
    protected $baseTitleSingular = 'Product';
    protected $variableNamePlural = 'products';
    protected $variableNameSingular = 'product';
    protected $baseRoute = 'manage/inventory';
    protected $viewIndex = 'manage.inventory.index';
    protected $viewCreate='manage.inventory.create';
    protected $viewShow='manage.inventory.show';
    protected $viewEdit='manage.inventory.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }
}
