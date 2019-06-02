@extends('layouts.app')
@section('content')
    @include('components.breadcrumb',[
        'links' => [
            '/manage/credential' => 'Credential',
            '/manage/credential/'.$credential->id => $credential->name,
        ],
    ])
    @component('components.panel',['title'=>$credential->name])
        @slot('action')
            <a href="{{ url($credential->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot

        <div class="row">
            <div class="col-lg-7">

                <div class="list-group">
                    @if($credential->url)
                        <div class="list-group-item list-group-item-light">
                            <strong><a href="{{ $credential->url }}" target="_blank">{{ $credential->url }} <span
                                            class="fa fa-external-link"></span></a></strong>
                        </div>
                    @endif
                    <div class="list-group-item list-group-item-light">
                        <div class="row">
                            @if($credential->username)
                                <div class="col">
                                    <strong>Username: </strong> <button rel="copyText" data-content="{{ $credential->username }}" class="btn btn-link">{{ $credential->username }}</button>
                                </div>
                            @endif
                            @if($credential->password)
                                <div class="col">
                                    <button rel="copyText" data-content="{{ $credential->password }}"
                                            class="btn btn-default">Copy Password
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($credential->created_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Created Date and Time </strong> {{ $credential->created_at }}
                        </div>
                    @endif
                </div>

            </div>

        </div>
    @endcomponent
@endsection
