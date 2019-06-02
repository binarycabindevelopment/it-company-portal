@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/employee' => 'Employees',
            '/manage/employee/'.$employee->id => $employee->name,
            '/manage/employee/'.$employee->id.'/pay-rate' => 'Pay Rates',
        ],
    ])

    @include('manage.employee.partials.subnav')

    @component('components.panel',['title'=>'Pay Rates'])

        @slot('action')
            <a href="{{ url('/manage/employee/'.$employee->id.'/pay-rate/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>@include('components.sort-button',['sortField'=>'hourly_amount_cents']) Hourly Amount</th>
                <th>@include('components.sort-button',['sortField'=>'rate_charge_cents']) Rate Charge</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach($payRates as $payRate)
                    <tr>
                        <td>${{ $payRate->hourly_amount }}</td>
                        <td>${{ $payRate->rate_charge_amount }}</td>
                        <td>
                            <a href="{{ url('/manage/employee/'.$employee->id.'/pay-rate/'.$payRate->id.'/edit') }}"
                               class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endcomponent

@endsection
