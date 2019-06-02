<?php

namespace App\Http\Controllers\Manage\Users;

use App\Http\Controllers\Manage\BaseManageController;

class UserController extends BaseManageController
{

    protected $modelClass = \App\User::class;
    protected $baseTitlePlural = 'Users';
    protected $baseTitleSingular = 'User';
    protected $variableNamePlural = 'users';
    protected $variableNameSingular = 'user';
    protected $baseRoute = 'manage/user';
    protected $viewIndex = 'manage.user.index';
    protected $viewCreate='manage.user.create';
    protected $viewEdit='manage.user.edit';
    protected $viewFields;

}
