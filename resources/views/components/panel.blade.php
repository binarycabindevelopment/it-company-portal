<?php
if(!isset($headerTextColorClass)){
    $headerTextColorClass = 'text-light';
}
if(!isset($headerTextBGClass)){
    $headerTextBGClass = 'bg-dark';
}
if(!isset($additionalClasses)){
    $additionalClasses = '';
}
?>

<div class="card border-0 {{ $additionalClasses }}">
    @if(isset($title))
        <div class="card-header d-flex justify-content-between {{ $headerTextColorClass }} {{ $headerTextBGClass }}">
            {!! $title !!}
            @if(isset($action))
                <div class="ActionElement">
                    {!! $action !!}
                </div>
            @endif
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>