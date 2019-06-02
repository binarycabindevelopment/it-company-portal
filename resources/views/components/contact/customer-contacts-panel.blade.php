<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-address-book"></span> Contacts';
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

    @foreach($contacts as $contact)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                    <p class="card-title mr-auto">
                        {{ $contact->last_name }}, {{ $contact->first_name }}
                        @if(!empty($contact->job_title))<br/><small><em>{{ $contact->job_title }}</em></small>@endif
                    </p>
                    @if($edit)
                    <p><a href="{{ url($editBasePath.'/'.$contact->id.'/edit') }}" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a></p>
                    @endif
                    @if($unlink)
                        {!! Former::open_vertical($editBasePath.'/'.$contact->id)->method('DELETE') !!}
                        <p><button class="btn btn-sm btn-danger"><span class="fa fa-chain-broken"></span></button></p>
                        {!! Former::close() !!}
                    @endif
            </div>
            <div class="card-body">
                    @if ($contact->user)
                        <p><a href="{{ url($baseRoute.'/'.$contact->contactable_id.'/contact/'.$contact->id.'/user/'.$contact->user->id.'/edit') }}" class="btn btn-block btn-info">Update user Information</a></p>
                    @else
                        <p><a href="{{ url($baseRoute.'/'.$contact->contactable_id.'/contact/'.$contact->id.'/user/create') }}" class="btn btn-block btn-info">Allow Login</a></p>
                    @endif
            </div>
            @if(!empty($contact->contact_types_list))
                <div class="card-footer">
                    <span class="badge badge-primary">{{ $contact->contact_types_list }}</span>
                </div>
            @endif
        </div>
    @endforeach

@endcomponent