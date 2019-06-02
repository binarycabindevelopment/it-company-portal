<?php
if(isset($addresses)){
    $addressesCount = $addresses->count();
}
if(!isset($addressesCount)){
    $addressesCount = 1;
}
?>

@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="addresses-container items-container" data-items-count="{{ $addressesCount }}">
        {!! Former::hidden('addresses_sync_input',true) !!}
        @for($i=0;$i<10;$i++)
        <div class="address-container item-container">
            {!! Former::hidden('addresses_input['.$i.'][weight]',0) !!}
            {!! Former::text('addresses_input['.$i.'][address_1]','Address 1') !!}
            {!! Former::text('addresses_input['.$i.'][address_2]','Address 2') !!}
            <div class="row">
                <div class="col-sm-5">
                    {!! Former::text('addresses_input['.$i.'][city]','City') !!}
                </div>
                <div class="col-sm-3">
                    {!! Former::select('addresses_input['.$i.'][state]','State')->options(\App\Options\State::get('--')) !!}
                </div>
                <div class="col-sm-4">
                    {!! Former::text('addresses_input['.$i.'][zipcode]','Zipcode') !!}
                </div>
            </div>
            <hr/>
        </div>
        @endfor

        <button rel="items-add-button" class="btn btn-sm btn-default" type="button"><span class="fa fa-plus"></span> Add</button>

    </div>

@endcomponent