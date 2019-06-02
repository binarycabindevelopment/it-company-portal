<div class="row">
    <div class="col">{!! Former::text('contact_input[title]','Title') !!}</div>
    <div class="col">{!! Former::text('contact_input[first_name]','First Name') !!}</div>
    <div class="col">{!! Former::text('contact_input[middle_name]','Middle Name') !!}</div>
    <div class="col">{!! Former::text('contact_input[last_name]','Last Name') !!}</div>
</div>

<div class="row">
    <div class="col">{!! Former::email('contact_input[email]','Email Address') !!}</div>
    <div class="col">{!! Former::text('contact_input[job_title]','Job Title') !!}</div>
</div>

<?php
$phonesInputData = [];
if($update){
    $phonesInputData['phones'] = $employee->contact->phones;
}
?>
@component('components.phone.contact-input-panel',$phonesInputData)
    Phone / Fax Numbers
@endcomponent

<?php
$addressesInputData = [];
if($update){
    $addressesInputData['addresses'] = $employee->contact->addresses;
}
?>
@component('components.address.contact-input-panel',$addressesInputData)
    Addresses
@endcomponent