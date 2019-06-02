<?php

namespace App\Http\Controllers\Manage\Assets;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class AssetController extends BaseManageController
{
    protected $modelClass = \App\Asset::class;
    protected $baseTitlePlural = 'Assets';
    protected $baseTitleSingular = 'Asset';
    protected $variableNamePlural = 'assets';
    protected $variableNameSingular = 'asset';
    protected $baseRoute = 'manage/asset';
    protected $viewIndex = 'manage.asset.index';
    protected $viewCreate='manage.asset.create';
    protected $viewShow='manage.asset.show';
    protected $viewEdit='manage.asset.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }

}
