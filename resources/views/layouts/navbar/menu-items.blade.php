@if(Auth::check())
    @if(!Auth::user()->isCustomer())
        @if(Auth::user()->clock)
            <li class="nav-link">
                <a href="{{ url('account/clock/0') }}" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom"
                   title="Clocked In Since: {{ Auth::user()->clock->created_at->format('g:ia') }}">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> Clock Out</a>
            </li>
        @else
            <li class="nav-link">
                <a href="{{ url('account/clock/1') }}" class="btn btn-success"
                   data-toggle="tooltip" data-placement="bottom"
                   title="Last Clock In: @if(Auth::user()->clock_last) {{ Auth::user()->clock_last->closed_at->format('D @ g:ia') }} @else [none] @endif">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> Clock In</a>
            </li>
        @endif
    @endif
    @if(Auth::user()->isAdmin())
        <li class="dropdown menu-item-administration nav-link">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fa fa-cog" aria-hidden="true"></i> Administration <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <a class="dropdown-item" href="{{ url('/manage/user') }}">Manage Users</a>
                <a class="dropdown-item" href="{{ url('/manage/support-vendor') }}">Manage Support Vendors</a>
                <a class="dropdown-item" href="{{ url('/manage/schedule/default') }}">Weekly Schedule</a>
                <a class="dropdown-item" href="{{ url('/manage/clock') }}">Clock In Times</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('manage/setting') }}">Manage Settings</a>
            </ul>
        </li>
    @endif
    <li class="dropdown menu-item-my-account nav-link">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <i class="fa fa-user" aria-hidden="true"></i> My Account <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <a class="dropdown-item" href="{{ url('account/user') }}">Login Credentials</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
                @include('layouts.navbar.logout-form')
            </a>
        </ul>
    </li>
@else
    <li class="nav-link menu-item-login">
        <a href="{{ url('/login') }}" class="nav-link">
            <i class="fa fa-user" aria-hidden="true"></i> Login</a>
    </li>
@endif