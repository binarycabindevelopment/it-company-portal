@if(Auth::check() && Auth::user()->isEmployee())

<a href="{{ url('/') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-home"></i> <span class="d-none d-md-inline">Dashboard</span>
</a>

<a href="{{ url('/manage/agenda') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-calendar"></i> <span class="d-none d-md-inline">Agenda</span>
</a>

<a href="{{ url('/manage/ticket') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-ticket"></i> <span class="d-none d-md-inline">Tickets</span>
</a>

<a href="{{ url('/manage/employee') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-users"></i> <span class="d-none d-md-inline">Employees</span>
</a>

<a href="{{ url('/manage/customer') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-handshake-o"></i> <span class="d-none d-md-inline">Customers</span>
</a>

<a href="{{ url('/manage/inventory') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-archive"></i> <span class="d-none d-md-inline">Inventory</span>
</a>

<a href="{{ url('/manage/asset') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-tags"></i> <span class="d-none d-md-inline">Assets</span>
</a>

<a href="{{ url('/manage/map') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-map"></i> <span class="d-none d-md-inline">Facility Maps</span>
</a>

<a href="{{ url('/manage/vehicle') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-car"></i> <span class="d-none d-md-inline">Company Vehicles</span>
</a>

<a href="{{ url('/manage/vehicle-inspection') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-home"></i> <span class="d-none d-md-inline">Vehicle Inspection Checklist</span>
</a>

<a href="{{ url('/manage/credential') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-lock"></i> <span class="d-none d-md-inline">Password Manager</span>
</a>

<a href="{{ url('/manage/monitor') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
    <i class="fa fa-globe"></i> <span class="d-none d-md-inline">Monitoring</span>
</a>

@endif

@if(Auth::check() && Auth::user()->isCustomer())
    <a href="{{ url('/account/customer/ticket') }}" class="list-group-item list-group-item-action d-inline-block collapsed" data-parent="#sidebar">
        <i class="fa fa-ticket"></i> <span class="d-none d-md-inline">My Tickets</span>
    </a>
@endif