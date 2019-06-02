<div class="row">
    <div class="col">{!! Former::text('email','E-Mail') !!}</div>
    <div class="col">{!! Former::password('password','Password') !!}</div>
    <div class="col">{!! Former::select('role','Role')->options(\App\Options\Role::get('---')) !!}</div>
</div>