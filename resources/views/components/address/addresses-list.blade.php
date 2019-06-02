
    <div class="list-group mb-2">
        @foreach($addresses as $address)
            <div class="list-group-item list-group-item-light">{!! $address->full_html !!}</div>
        @endforeach
    </div>
