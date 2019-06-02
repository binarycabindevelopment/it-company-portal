<a class="navbar-brand" href="{{ url('/') }}">
    @if(\App\Support\Branding\Branding::hasLogo())
        <img src="{{ asset('/branding/img/logo.png') }}" alt="{{ config('app.name') }}" />
    @else
        {{ config('app.name', 'Laravel') }}
    @endif
</a>