<?php
if(empty((string) $slot)){
    $slot = '<span class="fa fa-calendar"></span> Pay Rates';
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
            <a href="{{ url($basePath.'/payrate/create') }}" class="btn btn-primary btn-sm">Add</a>
        @endif
    @endslot


    @foreach($payRates as $payRate)
        <div class="card mb-2">
            <div class="card-header d-flex flex-row">
                <p class="card-title mr-auto"><br>
                    <em>
                        @if($payRate->hourly_amount_cents)
                            Hourly Amount (Cents)    {{ $payRate->hourly_amount_cents }}
                        @endif
                    </em>
                    <br/>
                    <em>
                        @if($payRate->rate_charge_amount_cents)
                             Rate Charge Amount (Cents) {{ $payRate->rate_charge_amount_cents }}
                        @endif
                    </em>
                </p>
                @if($edit)
                    <p><a href="{{ url($editBasePath.'/payrate/'.$payRate->id.'/edit') }}" class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></a></p>
                @endif
                @if($delete)
                    {!! Former::open_vertical($editBasePath.'/payrate/'.$payRate->id)->method('DELETE') !!}
                    <p><button class="btn btn-sm btn-danger"><span class="fa fa-chain-broken"></span></button></p>
                    {!! Former::close() !!}
                @endif
            </div>


        </div>
    @endforeach


@endcomponent