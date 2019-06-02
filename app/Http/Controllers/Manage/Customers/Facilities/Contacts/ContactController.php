<?php

namespace App\Http\Controllers\Manage\Customers\Facilities\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create($customerId, $facilityId){
        $facility = \App\Facility::findOrFail($facilityId);
        return view('manage.customer.facility.contact.create',[
            'facility'=>$facility,
            'customer'=>$facility->facilityable,
        ]);
    }

    public function store(Request $request, $customerId, $facilityId){
        $facility = \App\Facility::findOrFail($facilityId);
        if(!empty($request->contact_ids)){
            foreach($request->contact_ids as $contactId){
                \App\LinkedContact::create([
                    'contactable_id' => $facility->id,
                    'contactable_type' => get_class($facility),
                    'contact_id' => $contactId,
                ]);
            }
        }else{
            $contactData = $request->all();
            $contactData['contactable_type'] = get_class($facility->facilityable);
            $contactData['contactable_id'] = $facility->facilityable->id;
            $contact = \App\Contact::create($contactData);
            \App\LinkedContact::create([
                'contactable_id' => $facility->id,
                'contactable_type' => get_class($facility),
                'contact_id' => $contact->id,
            ]);
        }
        return redirect($facility->path())->withSuccess('Saved');
    }

}
