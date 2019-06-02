<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-map"></span> Map';
}
if(!isset($editBasePath)){
    $editBasePath = $basePath;
}
if(!isset($add)){
    $add = true;
}
if(!isset($edit)){
    $edit = false;
}
if(!isset($unlink)){
    $unlink = false;
}
?>
@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])
    <div class="list-group">
        @if($map)
            <?php dump($map); ?>
        @else
            <p class="text-danger">No mapping assigned</p>
            <p>[select a facililty map and plot...]</p>
        @endif
        @slot('action')
        @if($add)
        <a href="{{ url($basePath.'/create') }}" class="btn btn-primary btn-sm">Add</a>
        @endif
    @endslot
    </div>
@endcomponent