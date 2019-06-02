@extends('layouts.app-no-sidebar')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/map/'.$map->id => $map->name,
            '/manage/map/'.$map->id.'/view' => 'Map Manager',
        ],
    ])

    @component('components.panel',['title'=>$map->name])

        <div class="row">
            <div class="col-md">
                <div class="list-group">
                    @if($map->image)
                        @include('manage.map.view.partials.map',[
                            'map' => $map
                        ])
                    @endif
                </div>
            </div>
            <div class="col-md" style="max-width:400px; min-width:25%">

                @component('components.facility.customer-facility-panel',[
                            'facility'=>$map->mappable,
                        ])
                @endcomponent

                @component('components.panel',[
                    'title'=>'Other Maps',
                    'headerTextColorClass'=>'text-dark',
                    'headerTextBGClass'=>'bg-light',
                    'additionalClasses'=>'mb-2',
                ])
                    {!! Former::open_vertical('/manage/map/jump/view')->method('POST') !!}
                    <div class="row">
                        <div class="col-sm-8">
                            {!! Former::select('map_id','')->options(\App\Options\Map::get('---',[
                                'mappable_id' => $map->mappable_id,
                                'mappable_type' => $map->mappable_type,
                            ])) !!}
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-info btn-sm">Go</button>
                        </div>
                    </div>
                    {!! Former::close() !!}
                @endcomponent

                @component('components.asset.map-assets-panel',[
                      'assets'=>$map->assets,
                  ])
                @endcomponent

            </div>


        </div>

    @endcomponent

@endsection
