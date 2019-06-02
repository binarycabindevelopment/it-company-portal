@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Tickets'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        <div class="row">
            <div class="col-sm-4">
                {!! Former::select('ticketable_id','')->options(\App\Options\Facility::get('--Facility--'))->setAttribute('rel','datatable-filter') !!}
            </div>
        </div>

        <hr/>

        <div class="table-responsive">
            <table class="table table-bordered table-striped datatable-custom">
                <thead>
                <tr>
                    <th>!</th>
                    <th>Company</th>
                    <th>Description</th>
                    <th>Employees</th>
                    <th>Contacts</th>
                    <th>Status</th>
                    <th>Age</th>
                </tr>
                </thead>
            </table>
        </div>

    @endcomponent

@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
            var customDataTable = $('.datatable-custom').DataTable({
                //serverSide: true,
                ajax: {
                    url: "{{ url('/api/ticket') }}",
                    type: "GET",
                    data: function (d) {
                        return window.$.extend( {}, d, {
                            "ticketable_id": $('#ticketable_id').val()
                        } );
                    },
                },
                columns: [
                    {data: 'display_status_icon'},
                    {data: 'display_company_and_facility'},
                    {data: 'display_summary'},
                    {data: 'display_employees'},
                    {data: 'display_contacts'},
                    {data: 'display_status'},
                    {data: 'display_created_at_diff'},
                ],
                select: {
                    style: 'multi'
                }
            });
            $('[rel="datatable-filter"]').change(function(){
                let name = $(this).attr('name');
                let value = $(this).val();
                console.log(name);
                console.log(value);
                customDataTable.ajax.reload();
            });
        });
    </script>
@endsection