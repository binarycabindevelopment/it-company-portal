<div class="row">
    <div class="col-sm-6">{!! Former::text('first_name','First Name') !!}</div>
    <div class="col-sm-6">{!! Former::text('last_name','Last Name') !!}</div>
</div>
{!! Former::text('email','Email')->required() !!}
@if(!$update)
    {!! Former::password('password','Password') !!}
@else
    {!! Former::password('password','Password')->help('Leave blank to keep existing') !!}
@endif
{!! Former::select('role','Role')->options(\App\Options\Role::get('---')) !!}