@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="list-group">
        @foreach($addresses as $address)
            <div class="list-group-item list-group-item-light">{{ $address->full_html }}</div>
        @endforeach
    </div>


@endcomponent