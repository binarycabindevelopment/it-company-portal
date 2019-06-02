
<div class="row">
    <div class="col">{!! Former::text('make','Make')->required() !!}</div>
    <div class="col">{!! Former::text('model','Model')->required() !!}</div>
</div>
<div class="row">
    <div class="col">{!! Former::select('year','Year')->options(\App\Options\NumericRange::get('---',['start'=>1980,'end'=>date('Y')]))->required() !!}</div>
    <div class="col">{!! Former::text('vin','Vehicle Identification Number') !!}</div>
</div>
