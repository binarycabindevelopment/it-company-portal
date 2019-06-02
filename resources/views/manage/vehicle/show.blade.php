@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/vehicle' => 'Vehicles',
            '/manage/vehicle/'.$vehicle->id => $vehicle->vin,
        ],
    ])

    @component('components.panel',['title'=>$vehicle->vin])
        @slot('action')
            <a href="{{ url($vehicle->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">

                    @if($vehicle->make)
                        <div class="list-group-item list-group-item-light">
                            <strong>Make: </strong> {{ $vehicle->make }}
                        </div>
                    @endif
                    @if($vehicle->model)
                        <div class="list-group-item list-group-item-light">
                            <strong>Model: </strong> {{ $vehicle->model }}
                        </div>
                    @endif
                    @if($vehicle->year)
                        <div class="list-group-item list-group-item-light">
                            <strong>Year: </strong> {{ $vehicle->year }}
                        </div>
                    @endif
                    @if($vehicle->vin)
                        <div class="list-group-item list-group-item-light">
                            <strong>Vehicle Identification Number: </strong> {{ $vehicle->vin }}
                        </div>
                    @endif

                </div>
            </div>
            <div class="col-lg-5">


            </div>
        </div>

    @endcomponent

@endsection
