@extends('layouts.app')

@section('content')

    <div class="mb-4">
        @component('components.panel',['title'=>'Search'])
            {!! Former::open_vertical('/search')->method('GET') !!}
            {!! Former::text('search','') !!}
            <button class="btn btn-primary">Search</button>
            {!! Former::close() !!}
        @endcomponent
    </div>


    <h2>Results</h2>
    <p>No results found</p>

@endsection