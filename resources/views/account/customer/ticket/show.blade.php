
@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/account/customer/ticket' => 'Ticket',
            '/account/customer/ticket/'.$ticket->id => $ticket->title,
        ],
    ])

    @component('components.panel',['title'=>$ticket->title])
        @slot('action')
            <a href="{{ url($baseRoute.$ticket->id.'/edit') }}" class="btn btn-primary">Edit</a>
        @endslot
        <div class="row">
            <div class="col-lg-7">
                <div class="list-group">

                    @if($ticket->title)
                        <div class="list-group-item list-group-item-light">
                            <strong>Title: </strong> {{ $ticket->title }}
                        </div>
                    @endif
                    @if($ticket->service_board)
                        <div class="list-group-item list-group-item-light">
                            <strong>Service Board: </strong> {{ $ticket->service_board }}
                        </div>
                    @endif
                    @if($ticket->status)
                        <div class="list-group-item list-group-item-light">
                            <strong>Status: </strong> {{ $ticket->status }}
                        </div>
                    @endif
                    @if($ticket->type)
                        <div class="list-group-item list-group-item-light">
                            <strong>Type: </strong> {{ $ticket->type }}
                        </div>
                    @endif
                    @if($ticket->sub_type)
                        <div class="list-group-item list-group-item-light">
                            <strong>Sub Type: </strong> {{ $ticket->sub_type }}
                        </div>
                    @endif
                    @if($ticket->item)
                        <div class="list-group-item list-group-item-light">
                            <strong>Item: </strong> {{ $ticket->item }}
                        </div>
                    @endif
                    @if($ticket->source)
                        <div class="list-group-item list-group-item-light">
                            <strong>Source: </strong> {{ $ticket->source }}
                        </div>
                    @endif
                    @if($ticket->priority)
                        <div class="list-group-item list-group-item-light">
                            <strong>Priority: </strong> {{ $ticket->priority }}
                        </div>
                    @endif
                    @if($ticket->summary)
                        <div class="list-group-item list-group-item-light">
                            <strong>Summary: </strong> {{ $ticket->summary }}
                        </div>
                    @endif
                    @if($ticket->details)
                        <div class="list-group-item list-group-item-light">
                            <strong>Details: </strong> {{ $ticket->details }}
                        </div>
                    @endif
                    @if($ticket->analysis)
                        <div class="list-group-item list-group-item-light">
                            <strong>Summary: </strong> {{ $ticket->analysis }}
                        </div>
                    @endif
                    @if($ticket->resolution)
                        <div class="list-group-item list-group-item-light">
                            <strong>Resolution: </strong> {{ $ticket->resolution }}
                        </div>
                    @endif
                    @if($ticket->configuration_name)
                        <div class="list-group-item list-group-item-light">
                            <strong>Configuration Name: </strong> {{ $ticket->configuration_name }}
                        </div>
                    @endif
                    @if($ticket->resource_member)
                        <div class="list-group-item list-group-item-light">
                            <strong>Resource Member: </strong> {{ $ticket->resource_member }}
                        </div>
                    @endif
                    @if($ticket->completed_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Completed At: </strong> {{ $ticket->completed_at->format('m/d/Y g:ia') }}
                        </div>
                    @endif
                    @if($ticket->created_at)
                        <div class="list-group-item list-group-item-light">
                            <strong>Created At: </strong> {{ $ticket->created_at->format('m/d/Y g:ia') }}
                        </div>
                    @endif



                </div>
            </div>
            <div class="col-lg-5">


                @component('components.facility.facilities-panel',[
                        'facilities'=>$ticket->facilities,
                        'basePath' => $baseRoute.$ticket->id.'/facility',
                    ])
                    <span class="fa fa-building"></span> Facilities
                @endcomponent
                    {{--
                                    @component('components.contact.contacts-panel',[
                                      'contacts'=>$ticket->contacts,
                                      'basePath' => $ticket->path('/contact'),
                                      'edit' => false,
                                      'unlink' => true,
                                    ])
                                    @endcomponent

                                    @component('components.employee.employee-panel',[
                                         'employees'=>$ticket->employees,
                                         'basePath' => $ticket->path('/employee'),
                                         'edit' => false,
                                         'unlink' => true,
                                     ])
                                    @endcomponent

                                    @component('components.note.notes-panel',[
                                        'notes'=>$ticket->notes,
                                        'basePath' => $ticket->path('/note'),
                                        'edit' => true,
                                    ])
                                    @endcomponent

                    --}}


            </div>
        </div>

    @endcomponent


@endsection
