@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @component('components.panel',['title'=>'Reset Password'])

                {!! Former::open_vertical('/password/email')->method('POST') !!}

                {!! Former::email('email','Email Address')->required() !!}

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Send Password Reset Link
                        </button>
                    </div>
                </div>

                {!! Former::close() !!}

            @endcomponent

        </div>
    </div>
</div>
@endsection
