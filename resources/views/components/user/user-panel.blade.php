<?php
if (empty((string)$slot)) {
    $slot = '<span class="fa fa-user"></span> User Account';
}

?>

@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])
    <div class="list-group">
        @slot('action')
            @if ($user)
                <a href="{{url($basePath.'/'.$user->id.'/edit')}}" class="btn btn-primary btn-sm">Edit User</a>
            @else
                <a href="{{url($basePath.'/create')}}" class="btn btn-primary btn-sm">Add User</a>
            @endif
        @endslot
        @if ($user)
            <div class="list-group-item list-group-item-light">
                {{ $user->email }}
            </div>
        @endif
    </div>
@endcomponent