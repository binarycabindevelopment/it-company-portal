<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class BaseManageController extends Controller
{

    protected $modelClass;
    protected $baseTitlePlural;
    protected $baseTitleSingular;
    protected $variableNamePlural;
    protected $variableNameSingular;
    protected $baseRoute;
    protected $viewIndex;
    protected $viewCreate='manage.create';
    protected $viewEdit='manage.edit';
    protected $viewShow='manage.show';
    protected $viewFields;
    protected $paginationPer=25;

    public function __construct()
    {
        \View::share('baseTitlePlural',$this->baseTitlePlural);
        \View::share('baseTitleSingular',$this->baseTitleSingular);
        \View::share('variableNamePlural',$this->variableNamePlural);
        \View::share('variableNameSingular',$this->variableNameSingular);
        \View::share('baseRoute',$this->baseRoute);
        \View::share('viewFields',$this->viewFields);
    }

    public function index(Request $request){
        $modelClass = $this->modelClass;
        $query = $modelClass::query();



        if(method_exists($modelClass, 'scopeFilter')){
            $query->filter($request->all());
        }
        if(method_exists($modelClass, 'scopeSort')){
            $query->sort($request->all());
        }

        if(method_exists($modelClass, 'scopeArchived')){
            //$query->archived($request->all());
        }

        $models = $query->paginate($this->paginationPer);
        return view($this->viewIndex,[$this->variableNamePlural=>$models]);
    }

    public function create(){
        return view($this->viewCreate);
    }

    public function store(Request $request){
        $modelClass = $this->modelClass;
        $model = $modelClass::create($request->all());
        return redirect($this->baseRoute)->withSuccess('Saved!');
    }

    public function show($modelId){
        $modelClass = $this->modelClass;
        $model = $modelClass::where('id',$modelId)->first();
        return view($this->viewShow,[$this->variableNameSingular=>$model]);
    }

    public function edit($modelId){
        $modelClass = $this->modelClass;
        $model = $modelClass::where('id',$modelId)->first();
        return view($this->viewEdit,[$this->variableNameSingular=>$model]);
    }

    public function update(Request $request, $modelId){
        $modelClass = $this->modelClass;
        $model = $modelClass::where('id',$modelId)->first();
        $model->update($request->all());
        return redirect($this->redirectAfterUpdate($model))->withSuccess('Saved!');
    }

    public function destroy($modelId){
        $modelClass = $this->modelClass;
        $model = $modelClass::where('id',$modelId)->first();
        $model->delete();
        return redirect($this->baseRoute)->withSuccess('Deleted!');
    }

    protected function redirectAfterUpdate($model){
        return $this->baseRoute;
    }

}
