<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-link"></span> Links';
}
?>
@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])
    <div class="list-group">
        @foreach($links as $link)
            <a href="{{ $link->url }}" target="_blank" class="list-group-item list-group-item-light">{{ $link->label }}</a>
        @endforeach
    </div>
@endcomponent