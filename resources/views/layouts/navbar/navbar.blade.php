<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        @include('layouts.navbar.logo')
        @include('layouts.navbar.toggle')
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @include('layouts.navbar.menu-items')
            </ul>
        </div>
    </div>
</nav>