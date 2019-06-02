<?php

namespace App\Http\Controllers\Manage\Employees\PayRates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PayRateController extends Controller
{

    public function index($employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        $payRates = $employee->payRates;
        return view('manage.employee.pay-rate.index',[
            'employee'=>$employee,
            'payRates'=>$payRates,
        ]);
    }


    public function create($employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        return view('manage.employee.pay-rate.create',[
            'employee'=>$employee
        ]);
    }

    public function store(Request $request,$employeeId){

        $employee = \App\Employee::findOrFail($employeeId);
        $payRateData = $request->all();
        $payRateData['payable_id'] = $employee->id;
        $payRateData['payable_type'] = get_class($employee);
        $payRate = \App\PayRate::create($payRateData);
        return redirect('/manage/employee/'.$employeeId.'/pay-rate')->withSuccess('Saved');
    }

    public function edit($employeeId,$payRateId){

        $employee = \App\Employee::findOrFail($employeeId);
        $payRate = $employee->payRates()->where('id',$payRateId)->first();
        return view('manage.employee.pay-rate.edit',[
            'payRate'=>$payRate,
            'employee'=>$employee
        ]);
    }

    public function update(Request $request,$employeeId,$payRateId){
        $employee = \App\Employee::findOrFail($employeeId);
        $payRate = \App\PayRate::findOrFail($payRateId);
        $payRate->update($request->all());
        return redirect('/manage/employee/'.$employee->id.'/pay-rate')->withSuccess('Saved');
    }

    public function destroy(Request $request, $employeeId,$payRateId){
        $employee = \App\Employee::findOrFail($employeeId);
        $payRate = \App\PayRate::findOrFail($payRateId);
        $payRate->delete();
        return redirect('/manage/employee/'.$employeeId.'/pay-rate')->withSuccess('Deleted');
    }

}
