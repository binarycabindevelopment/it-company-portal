{!! Former::hidden('contact_types_sync_input',true) !!}
{!! Former::multiselect('contact_types_input','Type')->options(\App\Options\CustomerContactType::get()) !!}
{!! Former::multiselect('facilities_input','Facilities')->options([]) !!}

<div class="row">
    <div class="col">{!! Former::text('title','Title') !!}</div>
    <div class="col">{!! Former::text('first_name','First Name') !!}</div>
    <div class="col">{!! Former::text('middle_name','Middle Name') !!}</div>
    <div class="col">{!! Former::text('last_name','Last Name') !!}</div>
</div>

<div class="row">
    <div class="col">{!! Former::email('email','Email Address') !!}</div>
    <div class="col">{!! Former::text('job_title','Job Title') !!}</div>
</div>

<?php
$phonesInputData = [];
if($update){
    $phonesInputData['phones'] = $contact->phones;
}
?>
@component('components.phone.input-panel',$phonesInputData)
    Phone / Fax Numbers
@endcomponent

<?php
$addressesInputData = [];
if($update){
    $addressesInputData['addresses'] = $contact->addresses;
}
?>
@component('components.address.input-panel',$addressesInputData)
    Addresses
@endcomponent