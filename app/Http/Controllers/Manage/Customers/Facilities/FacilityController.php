<?php

namespace App\Http\Controllers\Manage\Customers\Facilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function create($customerId){
        $customer = \App\Customer::findOrFail($customerId);
        return view('manage.customer.facility.create',['customer'=>$customer]);
    }

    public function store(Request $request, $customerId){
        $customer = \App\Customer::findOrFail($customerId);
        $facilityData = $request->all();
        $facilityData['facilityable_type'] = get_class($customer);
        $facilityData['facilityable_id'] = $customer->id;
        $facility = \App\Facility::create($facilityData);
        return redirect($facility->path())->withSuccess('Saved');
    }

    public function show($customerId, $facilityId){
        $customer = \App\Customer::findOrFail($customerId);
        $facility = \App\Facility::findOrFail($facilityId);
        return view('manage.customer.facility.show',['customer'=>$customer,'facility'=>$facility]);
    }

    public function edit($customerId, $facilityId){
        $customer = \App\Customer::findOrFail($customerId);
        $facility = \App\Facility::findOrFail($facilityId);
        return view('manage.customer.facility.edit',['customer'=>$customer,'facility'=>$facility]);
    }

    public function update(Request $request, $customerId, $facilityId){
        $customer = \App\Customer::findOrFail($customerId);
        $facility = \App\Facility::findOrFail($facilityId);
        $facility->update($request->all());
        return redirect($facility->path())->withSuccess('Saved');
    }

    public function destroy($customerId, $facilityId){
        $customer = \App\Customer::findOrFail($customerId);
        $facility = \App\Facility::findOrFail($facilityId);
        $facility->delete();
        return redirect($customer->path())->withSuccess('Deleted');
    }


}
