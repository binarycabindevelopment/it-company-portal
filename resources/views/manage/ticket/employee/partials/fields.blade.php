
<div class="row">
    <div class="col">{!! Former::select('employee_id','Select Employee')->options(\App\Options\Employee::get('---'))->required() !!}</div>
</div>



