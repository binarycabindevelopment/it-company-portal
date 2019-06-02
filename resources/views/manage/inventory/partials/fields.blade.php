<?php
$imageInputData = [];
if($update){
    $imageInputData['image'] = $product->image;
}
?>
@component('components.image.input-panel',$imageInputData)
    Photo
@endcomponent
<div class="row">
    <div class="col">{!! Former::text('name','Name')->required() !!}</div>
    <div class="col">{!! Former::text('sku','SKU')->required() !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('category','Category')->required() !!}</div>
    <div class="col">{!! Former::text('supplier','Supplier') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('brand','Brand')->required() !!}</div>
    <div class="col">{!! Former::textarea('description','Description')->required() !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('buy_price','Price')->required()->prepend('$') !!}</div>
    <div class="col">{!! Former::text('wholesale_price','Wholesale Price')->required()->prepend('$') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('retail_price','Retail Price')->required()->prepend('$') !!}</div>
    <div class="col">{!! Former::text('stock','Stock') !!}</div>
</div>

