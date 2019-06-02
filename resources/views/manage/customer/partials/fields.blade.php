<?php
$logoInputData = [];
if($update){
    $logoInputData['logo'] = $customer->logo;
}
?>
@component('components.logo.input-panel',$logoInputData)
    Logo
@endcomponent

<div class="row">
    <div class="col-8">{!! Former::text('name','Name') !!}</div>
    <div class="col-4">{!! Former::text('key','Key') !!}</div>
</div>
<?php
$phonesInputData = [];
if($update){
    $phonesInputData['phones'] = $customer->phones;
}
?>
@component('components.phone.input-panel',$phonesInputData)
    Phone / Fax Numbers
@endcomponent

<?php
$addressesInputData = [];
if($update){
    $addressesInputData['addresses'] = $customer->addresses;
}
?>
@component('components.address.input-panel',$addressesInputData)
    Addresses
@endcomponent

<div class="row">
    <div class="col">{!! Former::text('sic_code','SIC Code') !!}</div>
    <div class="col">{!! Former::text('tax_code','Tax Code') !!}</div>
    <div class="col">{!! Former::text('tax_id','Tax Id') !!}</div>
</div>

<div class="row">
    <div class="col">{!! Former::text('number_of_employees','# of Employees') !!}</div>
    <div class="col">{!! Former::text('annual_revenue','Annual Revenue')->prepend('$') !!}</div>
</div>

<?php
$linksInputData = [];
if($update){
    $linksInputData['links'] = $customer->links;
}
?>
@component('components.link.input-panel',$linksInputData)
    Links
@endcomponent