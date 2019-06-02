<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-building"></span> Facility';
}
?>
@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])
    @if($facility)
        @if($facility->facilityable)
            @if($facility->facilityable->logo)
                <p class="text-center"><img src="{{ $facility->facilityable->logo->fileUrl() }}" height="100"/></p>
            @endif
            <h3><a href="{{ url($facility->facilityable->path()) }}">{{ $facility->facilityable->name }}</a></h3>
        @endif
        <h4><em><a href="{{ url($facility->path()) }}">{{ $facility->name }}</a></em></h4>
    @endif
@endcomponent