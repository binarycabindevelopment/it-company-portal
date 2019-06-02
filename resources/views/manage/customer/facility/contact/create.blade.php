@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id => $facility->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id.'/contact/create' => 'New Contact',
        ],
    ])

    @component('components.panel',['title'=>'New Contact For '.$facility->name])
        {!! Former::open_vertical('/manage/customer/'.$customer->id.'/facility/'.$facility->id.'/contact')->method('POST') !!}

        <div id="form-fields-accordion" data-children=".form-field-accordion-item">
            <p>
                <button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#form-fields-accordion" data-target="#form-fields-existing-contact">Link Existing Contact</button>
                <button type="button" class="btn btn-info" data-toggle="collapse" data-parent="#form-fields-accordion" data-target="#form-fields-new-contact">New Contact</button></p>
            <hr/>
            <div id="form-fields-existing-contact" role="tabpanel" class="collapse show" data-parent="#form-fields-accordion">
                @component('components.panel',['title'=>'Link Existing Contact'])
                    {!! Former::multiselect('contact_ids','Contacts')->options(\App\Options\Contact::get(null,['contactable_type'=>\App\Customer::class,'contactable_id'=>$customer->id,'ignore'=>$facility->contacts]))->addClass('multiselect') !!}
                    <button type="submit" class="btn btn-primary">Link Contact To This Facility</button>
                @endcomponent
            </div>
            <div id="form-fields-new-contact" role="tabpanel" class="collapse" data-parent="#form-fields-accordion">
                @component('components.panel',['title'=>'Add New Contact'])
                    @include('manage.customer.facility.contact.partials.fields',['update'=>false])
                    <button type="submit" class="btn btn-primary">Save New Contact</button>
                @endcomponent
            </div>
        </div>
        {!! Former::close() !!}
    @endcomponent

@endsection
