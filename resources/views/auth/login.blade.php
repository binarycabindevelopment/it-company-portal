@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                @component('components.panel',['title'=>'Login'])

                    {!! Former::open_vertical('/login') !!}

                    {!! Former::email('email','Email Address')->required() !!}
                    {!! Former::password('password','Password')->required() !!}

                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                    </div>

                    {!! Former::close() !!}

                @endcomponent

            </div>
        </div>
@endsection
