<?php

namespace App\Http\Controllers\Manage\SupportVendors;

use App\Http\Controllers\Manage\BaseManageController;

class SupportVendorController extends BaseManageController
{

    protected $modelClass = \App\SupportVendor::class;
    protected $baseTitlePlural = 'Support Vendors';
    protected $baseTitleSingular = 'Support Vendor';
    protected $variableNamePlural = 'supportVendors';
    protected $variableNameSingular = 'supportVendor';
    protected $baseRoute = 'manage/support-vendor';
    protected $viewIndex = 'manage.support-vendor.index';
    protected $viewCreate='manage.support-vendor.create';
    protected $viewEdit='manage.support-vendor.edit';
    protected $viewFields;

}
