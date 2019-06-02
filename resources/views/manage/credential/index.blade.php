@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Credential'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-3">
                    {!! Former::text('global','') !!}
                </div>
                <div class="col col-2">
                    <button type="submit" class="btn btn-default btn-block">Search</button>
                </div>
            </div>
            {!! Former::close() !!}
        @endcomponent

        <hr/>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th> @include('components.sort-button',['sortField'=>'name'])Name</th>
                <th>@include('components.sort-button',['sortField'=>'url'])Url</th>
                <th>@include('components.sort-button',['sortField'=>'username']) Username</th>
            </tr>
            </thead>
            <tbody>

                @foreach($credentials as $credential)


                    <tr>
                        <td><a href="{{ url( $credential->path()) }}" class="btn btn-primary">View</a></td>
                        <td>
                            @if($credential->name)
                                {{ $credential->name }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ $credential->url }}" target="_blank">{{ $credential->url }} <span
                                        class="fa fa-external-link"></span></a>
                        </td>
                        <td>
                            @if($credential->username)
                                {{ $credential->username }}
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {!! $credentials->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.credential.partials.scripts')
@endsection
