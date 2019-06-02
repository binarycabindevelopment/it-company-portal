@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="list-group">
        @foreach($phones as $phone)
            <div class="list-group-item list-group-item-light">{{ $phone->number }} ({{ $phone->type }})</div>
        @endforeach
    </div>


@endcomponent