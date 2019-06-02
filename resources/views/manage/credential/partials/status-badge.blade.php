@if($monitor->pingLast)
    @if($monitor->pingLast->status_code == $monitor->expected_status_code)
        <span class="badge  badge-success">Passing</span>
    @else
        <span class="badge badge-danger">Failing</span>
    @endif
@else
    <span class="badge badge-secondary">Not Run</span>
@endif