@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @component('components.panel',['title'=>'Reset Password'])

                {!! Former::open_vertical('/password/reset')->method('POST') !!}

                {!! Former::email('email','Email Address')->required() !!}

                {!! Former::password('password','Password')->required() !!}
                {!! Former::password('password_confirmation','Confirm Password')->required() !!}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </div>

                {!! Former::close() !!}

            @endcomponent

        </div>
    </div>
</div>
@endsection
