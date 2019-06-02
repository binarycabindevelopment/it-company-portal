<div class="row">
    <div class="col">{!! Former::text('title','Title') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('service_board','Service Board') !!}</div>
    <div class="col">{!! Former::text('status','Status') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::select('ticketable_id','Facility')->options(\App\Options\Facility::get('---'))->required() !!}</div>
    <div class="col">{!! Former::text('item','Item') !!}</div>
</div>
{!! Former::hidden('ticketable_type',\App\Facility::class) !!}
<div class="row">
    <div class="col">{!! Former::text('type','Type') !!}</div>
    <div class="col">{!! Former::text('sub_type','Sub Type') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('source','Source') !!}</div>
    <div class="col">{!! Former::text('priority','Priority') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::textarea('summary','Summary') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::textarea('details','Details') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::textarea('analysis','Analysis') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::textarea('resolution','Resolution') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('configuration_name','Configuration Name') !!}</div>
    <div class="col">{!! Former::text('completed_at_input','Completed At')->addClass('datetimepicker') !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::text('resource_member','Resource Member') !!}</div>
</div>



