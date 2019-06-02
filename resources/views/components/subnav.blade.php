<ul class="nav nav-tabs">
    @foreach($links as $linkURL => $linkTitle)
        <?php
        $active = false;
        if (trim(request()->path(),'/') == trim($linkURL,'/')) {
            $active = true;
        }
        ?>
        <li class="nav-item @if($active) active @endif">
            <a class="nav-link" href="{{ $linkURL }}">{{ $linkTitle }}</a>
        </li>
    @endforeach
</ul>