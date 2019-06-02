<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-address-book"></span> Linked Employees';
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
        @if($add)
            <a href="{{ url($basePath.'/create') }}" class="btn btn-primary btn-sm">Add</a>
        @endif
    @endslot

    @foreach($employees as $employee)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                <p class="card-title mr-auto">
                    {{ $employee->key }}

                </p>
                @if($edit)
                    <p><a href="{{ url($editBasePath.'/'.$employee->id.'/edit') }}" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a></p>
                @endif
                @if($unlink)
                    {!! Former::open_vertical($editBasePath.'/'.$employee->id)->method('DELETE') !!}
                    <p><button class="btn btn-sm btn-danger"><span class="fa fa-chain-broken"></span></button></p>
                    {!! Former::close() !!}
                @endif
            </div>
            <div class="card-body">
                <p>[details] / [linked facilities] / [linked maps]</p>
            </div>

        </div>
    @endforeach

@endcomponent