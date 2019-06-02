<?php
if(!isset($add)){
    $add = false;
}
if(!isset($edit)){
    $edit = false;
}
if(!isset($unlink)){
    $unlink = false;
}
?>
<div class="card mb-2">
    <div class="card-header d-flex flex-row">
        <p class="card-title mr-auto">
            {{ $contact->title }} {{ $contact->first_name }} {{ $contact->middle_name }} {{ $contact->first_name }}
            @if(!empty($contact->job_title))<br/><small><em>{{ $contact->job_title }}</em></small>@endif
            @if(!empty($contact->email))<br/>{{ $contact->email }}@endif
        </p>
    </div>
    <div class="card-body">
        <p>[details] / [linked facilities] / [linked maps]</p>
        @foreach($contact->phones as $phone)
        <ul class="list-group">
            <li class="list-group-item list-group-item-light">
                <span class="fa fa-phone"></span> {{ $phone->number }} <em>{{ $phone->type }}</em>
            </li>
        </ul>
        @endforeach

        @foreach($contact->addresses as $address)
            <ul class="list-group">
                <li class="list-group-item list-group-item-light">
                    <span class="fa fa-home"></span> {!! $address->full_html !!}
                </li>
            </ul>
        @endforeach

    </div>
    @if(!empty($contact->contact_types_list))
        <div class="card-footer">
            <span class="badge badge-primary">{{ $contact->contact_types_list }}</span>
        </div>
    @endif
</div>