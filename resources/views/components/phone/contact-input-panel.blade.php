<?php
if(isset($phones)){
    $phonesCount = $phones->count();
}
if(!isset($phonesCount)){
    $phonesCount = 1;
}
?>

@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="phones-container items-container" data-items-count="{{ $phonesCount }}">
        {!! Former::hidden('contact_input[phones_sync_input]',true) !!}
        @for($i=0;$i<10;$i++)
        <div class="phone-container item-container">
            <div class="row">
                {!! Former::hidden('contact_input[phones_input]['.$i.'][weight]',0) !!}
                <div class="col-4">
                    {!! Former::select('contact_input[phones_input]['.$i.'][type]','Type')->options(\App\Options\PhoneType::get('---')) !!}
                </div>
                <div class="col-8">
                    {!! Former::text('contact_input[phones_input]['.$i.'][number]','Number') !!}
                </div>
            </div>
            <hr/>
        </div>
        @endfor

        <button rel="items-add-button" class="btn btn-sm btn-default" type="button"><span class="fa fa-plus"></span> Add</button>

    </div>

@endcomponent