<?php
if(isset($links)){
    $linksCount = $links->count();
}
if(!isset($linksCount)){
    $linksCount = 1;
}
?>

@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="links-container items-container" data-items-count="{{ $linksCount }}">
        {!! Former::hidden('links_sync_input',true) !!}
        @for($i=0;$i<10;$i++)
        <div class="link-container item-container">
            <div class="row">
                {!! Former::hidden('links_input['.$i.'][weight]',0) !!}
                <div class="col">
                    {!! Former::text('links_input['.$i.'][label]','Label') !!}
                </div>
                <div class="col">
                    {!! Former::text('links_input['.$i.'][url]','URL') !!}
                </div>
            </div>
            <hr/>
        </div>
        @endfor

        <button rel="items-add-button" class="btn btn-sm btn-default" type="button"><span class="fa fa-plus"></span> Add</button>

    </div>

@endcomponent