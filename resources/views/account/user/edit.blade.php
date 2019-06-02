@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Account - User'])
        {!! Former::open_vertical('/account/user')->method('PATCH') !!}
        {!! Former::populate($user) !!}
        <div class="row">
            <div class="col-sm-6">
                {!! Former::text('first_name','First Name') !!}
            </div>
            <div class="col-sm-6">
                {!! Former::text('last_name','Last Name') !!}
            </div>
        </div>
        {!! Former::text('email','Email Address') !!}
        {!! Former::password('password','Password')->help('Leave blank to keep existing password') !!}
        <button type="submit" class="btn btn-primary">Save</button>
        {!! Former::close() !!}
    @endcomponent

@endsection
