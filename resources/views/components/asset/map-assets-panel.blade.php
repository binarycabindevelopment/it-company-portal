<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-tags"></span> Linked Assets';
}
?>
@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])
    @foreach($assets as $asset)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                <p class="card-title mr-auto">
                    {{ $asset->name }}
                </p>
            </div>
            <div class="card-body">
                <p>{{ $asset->category_label }}</p>
            </div>
        </div>
    @endforeach
@endcomponent