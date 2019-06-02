<?php

namespace App\Http\Controllers\Manage\Employees\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

     public function create($employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        return view('manage.employee.user.create',['employee'=>$employee]);
    }

    public function store(Request $request, $employeeId){ 
        $employee = \App\Employee::findOrFail($employeeId);
        $userData = $request->all();
        $userData['role'] = 'employee';
        $user = \App\User::create($userData);
        $employee->linkUser($user);
        return redirect($employee->path())->withSuccess('Saved');
    }


    public function edit($employeeId,$userId){
        $employee = \App\Employee::findOrFail($employeeId);
        $user = \App\User::findOrFail($userId);
        return view('manage.employee.user.edit',['employee'=>$employee,'user'=>$user]);
    }

    public function update(Request $request, $employeeId){

        $employee = \App\Employee::findOrFail($employeeId);
        $user = $employee->user;
        $user->update($request->all());
        return redirect($employee->path())->withSuccess('Saved');
    }

}
