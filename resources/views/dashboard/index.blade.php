@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-lg-12 grid-margin">
                <div class="card performance-cards">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex flex-row justify-content-center align-items-center">
                                <div class="wrapper icon-circle bg-warning">
                                    <i class="icon-tag icons"></i>
                                </div>
                                <div class="wrapper text-wrapper">
                                    <p class="text-dark">{{ $totalOpenTickets }}</p>
                                    <p>Open Tickets</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row justify-content-center align-items-center">
                                <div class="wrapper icon-circle bg-success">
                                    <i class="icon-check icons"></i>
                                </div>
                                <div class="wrapper text-wrapper">
                                    <p class="text-dark">{{ $totalClosedTickets }}</p>
                                    <p>Tickets Closed</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row justify-content-center align-items-center">
                                <div class="wrapper icon-circle bg-info">
                                    <i class="icon-briefcase icons"></i>
                                </div>
                                <div class="wrapper text-wrapper">
                                    <p class="text-dark">{{ $totalCustomerAccounts }}</p>
                                    <p>Customer Accounts</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row justify-content-center align-items-center">
                                <div class="wrapper icon-circle bg-primary">
                                    <i class="icon-user icons"></i>
                                </div>
                                <div class="wrapper text-wrapper">
                                    <p class="text-dark">{{ $totalEmployees }}</p>
                                    <p>Employees</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Recent Open Tickets</h4>
                        <div class="d-flex justify-content-between">
                            <div class="d-inline-block pt-3">

                                @foreach($recentOpenTickets as $recentOpenTicket)
                                    <h2 class="mb-0"><a href="{{ $recentOpenTicket->path() }}">{{ $recentOpenTicket->title }}</a></h2>
                                    <p class="mb-4"><small class="text-gray">{{ $recentOpenTicket->summary }}</small></p>
                                @endforeach

                            </div>
                            <div class="d-inline-block">
                                <div class="bg-warning px-4 py-2 rounded">
                                    <i class="mdi mdi-tag text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Recent Customers</h4>
                        <div class="d-flex justify-content-between">
                            <div class="d-inline-block pt-3">

                                @foreach($recentCustomers as $recentCustomer)
                                    <h2 class="mb-0"><a href="{{ $recentCustomer->path() }}">{{ $recentCustomer->name }}</a></h2>
                                    <p class="mb-4"><small class="text-gray">{{ $recentCustomer->key }}</small></p>
                                @endforeach

                            </div>
                            <div class="d-inline-block">
                                <div class="bg-info px-4 py-2 rounded">
                                    <i class="mdi mdi-briefcase text-white icon-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection