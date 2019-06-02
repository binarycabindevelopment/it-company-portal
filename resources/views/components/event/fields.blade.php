{!! Former::text('name','Name')->required() !!}
<div class="row">
    <div class="col">{!! Former::text('start_at_input','Event Start')->addClass('datetimepicker')->required() !!}</div>
    <div class="col">{!! Former::text('end_at_input','Event End')->addClass('datetimepicker')->required() !!}</div>
</div>
{!! Former::textarea('details','Details') !!}
{!! Former::select('type','Type')->options(\App\Options\EventType::get()) !!}
{!! Former::select('repeat','Repeat')->options(\App\Options\EventRepeat::get()) !!}
{!! Former::select('constraint','Is Constraint')->options(\App\Options\BooleanYesNo::get()) !!}