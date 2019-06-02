<nav class="breadcrumb">
    @foreach($links as $linkURL => $linkTitle)
        @if (!$loop->last)
            <a href="{{ $linkURL }}" class="breadcrumb-item">{{ $linkTitle }}</a></li>
        @else
            <span class="breadcrumb-item active">{{ $linkTitle }}</span>
        @endif
    @endforeach
</nav>