<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}">
            @if(\App\Support\Branding\Branding::hasLogo())
                <img src="{{ asset('/branding/img/logo.png') }}" alt="{{ config('app.name') }}" />
            @else
                {{ config('app.name') }}
            @endif
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            @if(\App\Support\Branding\Branding::hasLogo())
                <img src="{{ asset('/branding/img/logo-mini.png') }}" alt="{{ config('app.name') }}" />
            @else
                {{ config('app.name') }}
            @endif
        </a>
    </div>

    <div class="navbar-menu-wrapper d-flex align-items-center">

        @if(Auth::check())
        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item">
                {!! Former::open('/search')->method('GET')->class('mt-2 mt-md-0 d-none d-lg-block search-input')->id('searchForm') !!}
                    <div class="input-group">
                        <span class="input-group-addon d-flex align-items-center" onclick="javascript:document.getElementById('searchForm').submit();"><i class="icon-magnifier icons"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search..." style="width:200px;">
                    </div>
                {!! Former::close() !!}
            </li>
            <li class="nav-item dropdown mail-dropdown">
                <a class="nav-link count-indicator" id="MailDropdown" href="#" data-toggle="dropdown">
                    <i class="icon-envelope-letter icons"></i>
                    <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu navbar-dropdown mail-notification dropdownAnimation" aria-labelledby="MailDropdown">
                    <a class="dropdown-item" href="#">
                        <div class="sender-img">
                            <span class="badge badge-success">&nbsp;</span>
                        </div>
                        <div class="sender">
                            <p class="Sende-name">System</p>
                            <p class="Sender-message">No New Messages</p>
                        </div>
                    </a>
                    <?php /*
                    <a class="dropdown-item" href="#">
                        <div class="sender-img">
                            <span class="badge badge-success">&nbsp;</span>
                        </div>
                        <div class="sender">
                            <p class="Sende-name">Leanne Jones</p>
                            <p class="Sender-message">Can we schedule a call this afternoon?</p>
                        </div>
                    </a>
                    <a class="dropdown-item" href="#">
                        <div class="sender-img">
                            <span class="badge badge-primary">&nbsp;</span>
                        </div>
                        <div class="sender">
                            <p class="Sende-name">Stella</p>
                            <p class="Sender-message">Great presentation the other day. Keep up the good work!</p>
                        </div>
                    </a>
                    <a class="dropdown-item" href="#">
                        <div class="sender-img">
                            <span class="badge badge-warning">&nbsp;</span>
                        </div>
                        <div class="sender">
                            <p class="Sende-name">James Brown</p>
                            <p class="Sender-message">Need the updates of the project at the end of the week.</p>
                        </div>
                    </a>
                    <a href="#" class="dropdown-item view-all">View all</a>
                    */ ?>
                </div>
            </li>
            <li class="nav-item dropdown notification-dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="icon-speech icons"></i>
                    <span class="count"></span>
                </a>
                <div class="dropdown-menu navbar-dropdown preview-list notification-drop-down dropdownAnimation" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="icon-info mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject font-weight-medium">No New Notifications</p>
                            <p class="font-weight-light small-text">
                                Just now
                            </p>
                        </div>
                    </a>
                    <?php /*
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="icon-speech mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject">Settings</p>
                            <p class="font-weight-light small-text">
                                Private message
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon">
                                <i class="icon-envelope mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject">New user registration</p>
                            <p class="font-weight-light small-text">
                                2 days ago
                            </p>
                        </div>
                    </a>
 */ ?>
                </div>
            </li>
            <li class="nav-item d-none d-sm-block profile-img">
                <a class="nav-link profile-image" href="{{ url('/account') }}">
                    <img src="{{ asset('img/avatar.png') }}" alt="profile-img">
                    <?php /*<span class="online-status online bg-success"></span>*/ ?>
                </a>
            </li>
        </ul>
        @endif

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ml-auto" type="button" data-toggle="offcanvas">
            <span class="icon-menu icons"></span>
        </button>
    </div>

</nav>