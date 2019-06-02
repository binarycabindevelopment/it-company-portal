<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

@include('layouts.partials.head')

<body>

@include('layouts.navbar.navbar')

<div class="container-fluid">
    <div class="row d-flex d-md-block flex-nowrap wrapper">

        <main class="col-md-12 col pl-md-2 pt-2 main">

            @include('layouts.partials.notifications')

            @yield('content')

            @include('layouts.footer.footer')

        </main>

    </div>
</div>

@include('layouts.partials.bottom')

</body>

</html>