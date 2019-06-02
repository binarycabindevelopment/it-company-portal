<div class="row">
    <div class="col">{!! Former::select('customer_id','Customer')->options(\App\Options\Customer::get('---')) !!}</div>
    <div class="col">{!! Former::select('assetable_id','Facility')->options(\App\Options\Facility::get('---'))->required() !!}</div>
</div>
{!! Former::hidden('assetable_type',\App\Facility::class) !!}
<div class="row">
    <div class="col">{!! Former::text('name','Name') !!}</div>
    <div class="col">{!! Former::text('tag_key','Key') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('type','Type') !!}</div>
    <div class="col">{!! Former::select('category','Category')->options(\App\Options\AssetCategory::get('---')) !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('sales_vendor_name','Sales Vendor Name') !!}</div>
    <div class="col">{!! Former::select('support_vendor_id','Support Vendor')->options(\App\Options\SupportVendor::get('---')) !!}</div>
    <div class="col">{!! Former::text('manufacturer','Manufacturer') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('serial_number','Serial Number') !!}</div>
    <div class="col">{!! Former::text('model_number','Model Number') !!}</div>
    <div class="col">{!! Former::text('client_tag','Client Tag') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('purchase_at_input','purchase At')->addClass('datepicker') !!}</div>
    <div class="col">{!! Former::text('installed_at_input','Installed At')->addClass('datepicker') !!}</div>
    <div class="col">{!! Former::text('installed_by','Installed By') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('expires_at_input','Expires At')->addClass('datepicker') !!}</div>
    <div class="col">{!! Former::text('warranty_start_at_input','Warranty Start')->addClass('datepicker') !!}</div>
    <div class="col">{!! Former::text('warranty_end_at_input','Warranty End')->addClass('datepicker') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('configuration_status','Configuration Status') !!}</div>
    <div class="col">{!! Former::text('configuration_type','Configuration Type') !!}</div>
    <div class="col">{!! Former::text('configuration_name','Configuration Name') !!}</div>
</div>

<?php
$linksInputData = [];
if($update){
    $linksInputData['links'] = $asset->links;
}
?>
@component('components.link.input-panel',$linksInputData)
    Links
@endcomponent