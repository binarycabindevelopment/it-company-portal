<?php

namespace App\Http\Controllers\Manage\Credentials;

use App\Http\Controllers\Manage\BaseManageController;
use Illuminate\Http\Request;

class CredentialController extends BaseManageController
{
    protected $modelClass = \App\Credential::class;
    protected $baseTitlePlural = 'Credentials';
    protected $baseTitleSingular = 'Credential';
    protected $variableNamePlural = 'credentials';
    protected $variableNameSingular = 'credential';
    protected $baseRoute = 'manage/credential';
    protected $viewIndex = 'manage.credential.index';
    protected $viewCreate='manage.credential.create';
    protected $viewShow='manage.credential.show';
    protected $viewEdit='manage.credential.edit';
    protected $viewFields;

    protected function redirectAfterUpdate($model) {
        return $model->path();
    }

    

}
