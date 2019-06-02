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

    @slot('action')
        <a href="{{ url($basePath.'/create') }}" class="btn btn-primary btn-sm">Add</a>
    @endslot

    @foreach($maps as $map)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                <p class="card-title mr-auto">
                    {{ $map->name }}
                </p>
                <p><a href="{{ url($basePath.'/'.$map->id.'/edit') }}" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a></p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        @if($map->image)
                            <p><img src="{{ $map->image->fileUrl() }}" class="img-fluid"/></p>
                        @endif
                    </div>
                    <div class="col-8">
                        <p><a href="{{ url($map->path()) }}" class="btn btn-block btn-info">View</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endcomponent