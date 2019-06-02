@if(Auth::check())
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        @if(!Auth::user()->isCustomer())
            <ul class="nav" style="padding-top:25px;">
                @if(Auth::user()->clockedIn())
                    <li class="nav-link">
                        <a href="{{ url('account/clock/0') }}" class="btn btn-danger btn-block" data-toggle="tooltip"
                           data-placement="bottom"
                           title="Clocked In Since: {{ Auth::user()->getClockedInClock()->created_at->format('g:ia') }}">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> Clock Out</a>
                    </li>
                @else
                    <li class="nav-link">
                        <a href="{{ url('account/clock/1') }}" class="btn btn-success btn-block"
                           data-toggle="tooltip" data-placement="bottom"
                           title="Last Clock In: @if(Auth::user()->getLastClockIn()) {{ Auth::user()->getLastClockIn()->closed_at->format('D @ g:ia') }} @else [none] @endif">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> Clock In</a>
                    </li>
                @endif
            </ul>
            <ul class="nav">
                <li class="nav-item nav-category">
                    <span class="nav-link">SUPPORT</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">
                        <span class="menu-title">Dashboard</span>
                        <i class="icon-speedometer menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/agenda') }}">
                        <span class="menu-title">Agenda</span>
                        <i class="icon-calendar menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/ticket') }}">
                        <span class="menu-title">Tickets</span>
                        <i class="icon-tag menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/customer') }}">
                        <span class="menu-title">Customers</span>
                        <i class="icon-briefcase menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/asset') }}">
                        <span class="menu-title">Assets</span>
                        <i class="icon-organization menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/map') }}">
                        <span class="menu-title">Facility Maps</span>
                        <i class="icon-map menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/vehicle') }}">
                        <span class="menu-title">Company Vehicles</span>
                        <i class="icon-paper-plane menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manage/vehicle-inspection') }}">
                        <span class="menu-title">Vehicle Inspection Checklist</span>
                        <i class="icon-book-open menu-icon"></i>
                    </a>
                </li>


                @if(Auth::user()->isAdmin())
                    <li class="nav-item nav-category">
                        <span class="nav-link">ADMIN</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/user') }}">
                            <span class="menu-title">Users</span>
                            <i class="icon-user menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/employee') }}">
                            <span class="menu-title">Employees</span>
                            <i class="icon-user menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/inventory') }}">
                            <span class="menu-title">Inventory</span>
                            <i class="icon-social-dropbox menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/support-vendor') }}">
                            <span class="menu-title">Support Vendors</span>
                            <i class="icon-layers menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/schedule/default') }}">
                            <span class="menu-title">Weekly Schedule</span>
                            <i class="icon-list menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/clock') }}">
                            <span class="menu-title">Clock In Times</span>
                            <i class="icon-clock menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/credential') }}">
                            <span class="menu-title">Password Manager</span>
                            <i class="icon-key menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/monitor') }}">
                            <span class="menu-title">Monitoring</span>
                            <i class="icon-screen-desktop menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/manage/setting') }}">
                            <span class="menu-title">Settings</span>
                            <i class="icon-wrench menu-icon"></i>
                        </a>
                    </li>
                @endif

                <li class="nav-item nav-category">
                    <span class="nav-link">MY ACCOUNT</span>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('account/user') }}">
                        <span class="menu-title">Account Settings</span>
                        <i class="icon-user menu-icon"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="menu-title">Logout</span>
                        <i class="icon-close menu-icon"></i>
                        @include('layouts.navbar.logout-form')
                    </a>
                </li>
            </ul>
        @endif
    </nav>
@else
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-category">
                <span class="nav-link">MY ACCOUNT</span>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}">
                    <span class="menu-title">Login</span>
                    <i class="icon-user menu-icon"></i>
                </a>
            </li>
        </ul>
    </nav>
@endif