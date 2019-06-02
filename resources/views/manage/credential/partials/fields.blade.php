{!! Former::text('name','Name')->help('Name of service') !!}
{!! Former::text('url','URL') !!}
<div class="row">
    <div class="col">{!! Former::text('username','Username') !!}</div>
    <div class="col">{!! Former::password('password','Password') !!}</div>
</div>
