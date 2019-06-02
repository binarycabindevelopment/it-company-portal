<?php
$imageInputData = [];
if($update){
    $imageInputData['image'] = $facility->logo;
}
?>
@component('components.image.input-panel',$imageInputData)
    Image
@endcomponent

<div class="row">
    <div class="col-8">{!! Former::text('name','Name') !!}</div>
    <div class="col-4">{!! Former::text('key','Key') !!}</div>
</div>
<?php
$phonesInputData = [];
if($update){
    $phonesInputData['phones'] = $facility->phones;
}
?>
@component('components.phone.input-panel',$phonesInputData)
    Phone / Fax Numbers
@endcomponent

<?php
$addressesInputData = [];
if($update){
    $addressesInputData['phones'] = $facility->phones;
}
?>
@component('components.address.input-panel',$addressesInputData)
    Addresses
@endcomponent

<div class="row">
    <div class="col">{!! Former::text('number_of_employees','# of Employees') !!}</div>
    <div class="col">{!! Former::text('annual_revenue','Annual Revenue')->prepend('$') !!}</div>
</div>

<?php
$linksInputData = [];
if($update){
    $linksInputData['links'] = $facility->links;
}
?>
@component('components.link.input-panel',$linksInputData)
    Links
@endcomponent