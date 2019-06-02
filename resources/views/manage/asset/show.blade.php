@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Assets',
            '/manage/asset/'.$asset->id => $asset->name,
        ],
    ])

    @component('components.panel',['title'=>$asset->name])
        @slot('action')
            <a href="{{ url($asset->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">

                    <div class="row">
                        <div class="col">
                            @component('components.panel',['title'=>'Tag #','additionalClasses'=>'mb-2'])
                                <h2 class="text-center">{{ $asset->tag_key }}</h2>
                            @endcomponent
                        </div>
                        @if($asset->category)
                            <div class="col">
                                @component('components.panel',['title'=>'Category','additionalClasses'=>'mb-2'])
                                    <h2 class="text-center">{{ $asset->category_label }}</h2>
                                @endcomponent
                            </div>
                        @endif
                    </div>

                    @if($asset->supportVendor)
                        <div class="list-group-item list-group-item-light">
                            <strong>Support Vendor: </strong> {{ $asset->supportVendor->name }}
                        </div>
                    @endif
                    @if($asset->type)
                        <div class="list-group-item list-group-item-light">
                            <strong>Type: </strong> {{ $asset->type }}
                        </div>
                    @endif
                    @if($asset->sales_vendor_name)
                        <div class="list-group-item list-group-item-light">
                            <strong>Sales Vendor Name: </strong> {{ $asset->sales_vendor_name }}
                        </div>
                    @endif
                    @if($asset->manufacturer)
                        <div class="list-group-item list-group-item-light">
                            <strong>Manufacturer: </strong> {{ $asset->manufacturer }}
                        </div>
                    @endif
                    @if($asset->serial_number)
                        <div class="list-group-item list-group-item-light">
                            <strong>Serial Number: </strong> {{ $asset->serial_number }}
                        </div>
                    @endif
                    @if($asset->model_number)
                        <div class="list-group-item list-group-item-light">
                            <strong>Model Number: </strong> {{ $asset->model_number }}
                        </div>
                    @endif
                    @if($asset->client_tag)
                        <div class="list-group-item list-group-item-light">
                            <strong>Client Tag: </strong> {{ $asset->client_tag }}
                        </div>
                    @endif
                    @if($asset->purchase_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Purchase Date: </strong> {{ $asset->purchase_at->format('m/d/Y') }}
                        </div>
                    @endif
                    @if($asset->installed_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Installed Date: </strong> {{ $asset->installed_at->format('m/d/Y') }}
                        </div>
                    @endif
                    @if($asset->installed_by)
                        <div class="list-group-item list-group-item-light">
                            <strong>Installed By: </strong> {{ $asset->installed_by }}
                        </div>
                    @endif
                    @if($asset->expires_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Expires Date: </strong> {{ $asset->expires_at->format('m/d/Y') }}
                        </div>
                    @endif
                    @if($asset->configuration_status)
                        <div class="list-group-item list-group-item-light">
                            <strong>Configuration Status: </strong> {{ $asset->configuration_status }}
                        </div>
                    @endif
                    @if($asset->configuration_type)
                        <div class="list-group-item list-group-item-light">
                            <strong>Configuration Type: </strong> {{ $asset->configuration_type }}
                        </div>
                    @endif
                    @if($asset->configuration_name)
                        <div class="list-group-item list-group-item-light">
                            <strong>Configuration Name: </strong> {{ $asset->configuration_name }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5">

                @component('components.facility.customer-facility-panel',[
                            'facility'=>$asset->assetable,
                        ])
                @endcomponent

                @component('components.link.links-panel',[
                        'links'=>$asset->links,
                    ])
                @endcomponent

                @component('components.contact.contacts-panel',[
                    'contacts'=>$asset->contacts,
                    'basePath' => $asset->path('/contact'),
                    'unlink' => true,
                ])
                @endcomponent

                @component('components.map.maps-panel',[
                            'maps'=>$asset->maps,
                            'basePath' => $asset->path('/map'),
                        ])
                @endcomponent

                @component('components.asset.assets-panel',[
                            'assets'=>$asset->assets,
                            'basePath' => $asset->path('/asset'),
                        ])
                @endcomponent

            </div>
        </div>

    @endcomponent

@endsection
