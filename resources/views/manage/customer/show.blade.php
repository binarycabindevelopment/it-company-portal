<?php
$title = $customer->name;
if (!empty($customer->key)) {
    $title .= ' (' . $customer->key . ')';
}
?>
@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/customer' => 'Customers',
            '/manage/customer/'.$customer->id => $customer->name,
        ],
    ])

    @component('components.panel',['title'=>$title])
        @slot('action')
            <a href="{{ url($customer->path('/edit')) }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                @if($customer->logo)
                    <p><img src="{{ $customer->logo->fileUrl() }}" height="100"/></p>
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
                        <td>{{ $customer->number_of_employees }}</td>
                        <td>${{ number_format($customer->annual_revenue,2) }}</td>
                    </tr>
                    </tbody>
                </table>
                <p>
                    <small>
                        <strong>SIC Code:</strong> {{ $customer->sic_code }}<br/>
                        <strong>Tax Code:</strong> {{ $customer->tax_code }}<br/>
                        <strong>Tax Id:</strong> {{ $customer->tax_id }}
                    </small>
                </p>
                <hr/>
                @include('components.address.addresses-list',[
                    'addresses'=>$customer->addresses,
                ])

                @component('components.contact.customer-contacts-panel',[
                'contacts'=>$customer->contacts,
                'basePath' => $customer->path('/contact'),
                'edit' => true,
            ])
                @endcomponent
            </div>
            <div class="col-lg-5">
                @include('components.phone.phones-list',[
                    'phones'=>$customer->phones,
                ])

                @component('components.facility.facilities-panel',[
                        'facilities'=>$customer->facilities,
                        'basePath' => $customer->path('/facility'),
                    ])
                    <span class="fa fa-building"></span> Facilities
                @endcomponent
                <hr/>
                @component('components.link.links-panel',['links'=>$customer->links])@endcomponent
            </div>
        </div>

    @endcomponent

@endsection
