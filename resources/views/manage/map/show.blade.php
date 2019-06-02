@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/map' => 'Maps',
            '/manage/map/'.$map->id => $map->name,
        ],
    ])

    @component('components.panel',['title'=>$map->name])
        @slot('action')
            <a href="{{ url($map->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">

                    <p><a href="{{ url($map->pathView()) }}" class="btn btn-primary"><span class="fa fa-map-marker"></span> Open Map Manager</a></p>
                    @if($map->image)
                        <p><img src="{{ $map->image->fileUrl() }}" class="img-fluid"/></p>
                    @endif
                        <div class="list-group-item list-group-item-light">
                            <strong>Created: </strong> {{ $map->created_at->format('m/d/Y') }}
                        </div>
                </div>
            </div>
            <div class="col-lg-5">

                @component('components.facility.customer-facility-panel',[
                            'facility'=>$map->mappable,
                        ])
                @endcomponent
                @component('components.asset.map-assets-panel',[
                      'assets'=>$map->assets,
                  ])
                @endcomponent

            </div>


        </div>

    @endcomponent

@endsection
