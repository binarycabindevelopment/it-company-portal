<div class="row">
    
    <div class="col">{!! Former::select('facility_id','Facility')->options(\App\Options\Facility::get('---'))->required() !!}</div>
</div>
{!! Former::hidden('facilityable_type',\App\Ticket::class) !!}
