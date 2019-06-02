<?php

namespace App\Http\Controllers\Manage\Customers\Contacts\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

     public function create($customerId,$contactId){
         $customer = \App\Customer::findOrFail($customerId);
         $contact = \App\Contact::findOrFail($contactId);
        return view('manage.customer.contact.user.create',['customer'=>$customer,'contact'=>$contact]);
    }

    public function store(Request $request, $customerId,$contactId){
        $customer = \App\Customer::findOrFail($customerId);
        $contact = \App\Contact::findOrFail($contactId);
        $userData = $request->all();
        $userData['role'] = 'customer';
        $user = \App\User::create($userData);
        $linkedUser = $contact->linkUser($user);
        return redirect($customer->path())->withSuccess('Saved');
    }


    public function edit($customerId,$contactId,$userId){
        $customer = \App\Customer::findOrFail($customerId);
        $contact = \App\Contact::findOrFail($contactId);
        $user = \App\User::findOrFail($userId);
        return view('manage.customer.contact.user.edit',['customer'=>$customer,'contact'=>$contact,'user'=>$user]);
    }

    public function update(Request $request,$customerId,$contactId,$userId){
        $customer = \App\Customer::findOrFail($customerId);
        $user = \App\User::findOrFail($userId);
        $user->update($request->all());
        return redirect($customer->path())->withSuccess('Saved');
    }
}
