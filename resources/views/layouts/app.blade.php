<!DOCTYPE html>
<html lang="en">

@include('components.layout.head')

<body>
<div id="app" class="container-scroller">
    @include('components.layout.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="row row-offcanvas row-offcanvas-right">
            @include('components.layout.sidebar')

            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin">

                        @include('layouts.partials.notifications')

                        @yield('content')

                        @include('layouts.footer.footer')

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@include('components.layout.scripts')
</body>

</html>