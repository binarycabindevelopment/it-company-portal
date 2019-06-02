<?php

namespace App\Http\Controllers\Manage\Customers\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create($customerId){
        $customer = \App\Customer::findOrFail($customerId);
        return view('manage.customer.contact.create',['customer'=>$customer]);
    }

    public function store(Request $request, $customerId){
        $customer = \App\Customer::findOrFail($customerId);
        $contactData = $request->all();
        $contactData['contactable_type'] = get_class($customer);
        $contactData['contactable_id'] = $customer->id;
        $contact = \App\Contact::create($contactData);
        return redirect($customer->path())->withSuccess('Saved');
    }

    public function edit($customerId, $contactId){
        $customer = \App\Customer::findOrFail($customerId);
        $contact = \App\Contact::findOrFail($contactId);
        return view('manage.customer.contact.edit',['customer'=>$customer,'contact'=>$contact]);
    }

    public function update(Request $request, $customerId, $contactId){
        $customer = \App\Customer::findOrFail($customerId);
        $contact = \App\Contact::findOrFail($contactId);
        $contact->update($request->all());
        return redirect($customer->path())->withSuccess('Saved');
    }

    public function destroy($customerId, $contactId){
        $customer = \App\Customer::findOrFail($customerId);
        $contact = \App\Contact::findOrFail($contactId);
        $contact->delete();
        return redirect($customer->path())->withSuccess('Deleted');
    }


}
