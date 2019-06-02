<div class="row">
    <div class="col">{!! Former::select('expected_status_code','Expected Status Code')->options(\App\Options\HttpStatusCode::get()) !!}</div>
    <div class="col">{!! Former::text('expected_response_content','Expected Response Content') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('url','URL') !!}</div>
</div>
