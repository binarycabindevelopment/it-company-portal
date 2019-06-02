@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
            '/manage/customer/'.$customer->id.'/facility/'.$facility->id => $facility->name,
        ],
    ])

    @component('components.panel',['title'=>$facility->name])
        @slot('action')
            <a href="{{ url($facility->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                @if($facility->image)
                    <p><img src="{{ $facility->image->fileUrl() }}" height="100"/></p>
                @endif
                <table class="table table-responsive table-bordered">
                    <thead>
                    <tr>
                        <th># Employees</th>
                        <th>Annual Revenue</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $facility->number_of_employees }}</td>
                        <td>${{ number_format($facility->annual_revenue,2) }}</td>
                    </tr>
                    </tbody>
                </table>
                <hr/>

                @include('components.address.addresses-list',[
                        'addresses'=>$customer->addresses,
                    ])
                @component('components.contact.contacts-panel',[
                    'contacts'=>$facility->contacts,
                    'basePath' => $facility->path('/contact'),
                    'editBasePath' => $customer->path('/contact'),
                    'unline' => true,
                ])
                    <span class="fa fa-address-book"></span> Contacts
                @endcomponent
            </div>
            <div class="col-lg-5">

                @include('components.phone.phones-list',[
                    'phones'=>$customer->phones,
                ])
                @component('components.map.maps-panel',[
                'maps'=>$facility->maps,
                'basePath' => $facility->path('/map'),
                ])
                    <span class="fa fa-map"></span> Maps
                @endcomponent
                <hr/>
                @component('components.link.links-panel',[
                    'links'=>$facility->links,
                ])
                    <span class="fa fa-link"></span> Links
                @endcomponent
            </div>
        </div>

    @endcomponent

@endsection
