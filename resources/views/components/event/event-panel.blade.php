<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-calendar"></span> Events';
}
if(!isset($editBasePath)){
    $editBasePath = $basePath;
}
if(!isset($add)){
    $add = true;
}
if(!isset($edit)){
    $edit = true;
}
if(!isset($delete)){
    $delete = false;
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

    @foreach($events as $event)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                <p class="card-title mr-auto">{{ $event->name }}<br>
                    <small>
                        @if($event->start_at)
                            {{ $event->start_at->format('m/d/Y g:ia') }}
                        @endif
                        -
                        @if($event->end_at)
                            {{ $event->end_at->format('m/d/Y g:ia') }}
                        @endif
                    </small>
                </p>
                @if($edit)
                    <p><a href="{{ url($editBasePath.'/'.$event->id.'/edit') }}" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a></p>
                @endif
                @if($delete)
                    {!! Former::open_vertical($editBasePath.'/'.$event->id)->method('DELETE') !!}
                    <p><button class="btn btn-sm btn-danger"><span class="fa fa-chain-broken"></span></button></p>
                    {!! Former::close() !!}
                @endif
            </div>
            @if(!empty($event->details))
            <div class="card-body">
                <p>
                    {{ $event->details }}
                </p>
            </div>
                @endif

        </div>
    @endforeach

@endcomponent