<div class="row">
    <div class="col">{!! Former::select('customer_id','Customer')->options(\App\Options\Customer::get('---')) !!}</div>
    <div class="col">{!! Former::select('mappable_id','Facility')->options(\App\Options\Facility::get('---'))->required() !!}</div>
</div>
{!! Former::hidden('mappable_type',\App\Facility::class) !!}
{!! Former::text('name','Name')->required() !!}
{!! Former::file('image_file','Upload Image') !!}