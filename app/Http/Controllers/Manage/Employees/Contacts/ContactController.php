<?php

namespace App\Http\Controllers\Manage\Employees\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function store(Request $request, $customerId){
        $employee = \App\Employee::findOrFail($customerId);
        $contactData = $request->all();
        $contactData['contactable_type'] = get_class($employee);
        $contactData['contactable_id'] = $employee->id;
        $contact = \App\Contact::create($contactData);
        return redirect($customer->path())->withSuccess('Saved');
    }


    public function edit($employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        $contact = $employee->contact;


        return view('manage.employee.contact.edit',['employee'=>$employee,'contact'=>$contact]);
    }

    public function update(Request $request, $employeeId){
        $employee = \App\Employee::findOrFail($employeeId);
        $contact = $employee->contact;
        $contact->update($request->all());
        return redirect($employee->path())->withSuccess('Saved');
    }

}
