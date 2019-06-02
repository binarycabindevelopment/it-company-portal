@extends('layouts.app')

@section('content')

    @component('components.panel',['title'=>'Manage Asset'])
        @slot('action')
            <a href="{{ url($baseRoute.'/create') }}" class="btn btn-primary btn-sm"><span
                        class="glyphicon glyphicon-plus"></span> Create</a>
        @endslot

        @component('components.panel',[])
            {!! Former::open_vertical()->method('GET') !!}
            <div class="row justify-content-end">
                <div class="col col-2">{!! Former::select('archived','')->options(\App\Options\ArchivedStatusFilter::get('--Archived--')) !!}</div>
                <div class="col col-2">{!! Former::select('customer_id','')->options(\App\Options\Customer::get('--Customer--')) !!}</div>
                <div class="col col-2">{!! Former::select('assetable_id','')->options(\App\Options\Facility::get('--Facility--')) !!}</div>
                <div class="col col-3">
                    {!! Former::text('global','') !!}
                </div>
                <div class="col col-2">
                    <button type="submit" class="btn btn-default btn-block">Search</button>
                </div>
            </div>
            {!! Former::close() !!}
        @endcomponent

        <hr/>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>@include('components.sort-button',['sortField'=>'category']) Category</th>
                <th>Company</th>
                <th>Contacts</th>
                <th>@include('components.sort-button',['sortField'=>'name']) Name</th>
                <th>@include('components.sort-button',['sortField'=>'tag_key']) Tag Key</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($assets as $asset)
                <tr>
                    <td><a href="{{ url($asset->path()) }}" class="btn btn-primary">View</a></td>
                    <td>{{ $asset->category_label }}</td>
                    <td>
                        @if($asset->assetable)
                            @if($asset->assetable->facilityable)
                                <a href="{{ url($asset->assetable->facilityable->path()) }}">{{ $asset->assetable->facilityable->name }}</a>
                                <br/>
                            @endif
                            <em><a href="{{ url($asset->assetable->path()) }}">{{ $asset->assetable->name }}</a></em>
                        @endif
                    </td>
                    <td>
                        @foreach($asset->contacts as $contact)
                            <div>{{ $contact->name }}</div>
                        @endforeach
                    </td>
                    <td>
                        @if($asset->archived)
                            <div><span class="badge badge-secondary">Archived</span></div>
                        @endif
                        {{ $asset->name }}
                    </td>
                    <td>
                        {{ $asset->tag_key }}<br/>
                        @if($asset->expires_at)
                        <strong @if($asset->expires_at->lt(\Carbon\Carbon::now())) class="text-danger" @endif>Exp.:</strong> {{ $asset->expires_at->format('m/d/Y') }}
                        @endif
                    </td>
                    <td>
                        @if($asset->maps->count() > 0)
                            <a href="#" class="btn btn-info btn-block">View On Map</a>
                        @else
                            <span class="text-danger">Unmapped</span>
                        @endif
                        @foreach($asset->links as $link)
                            <a href="{{ $link->url }}" target="_blank"
                               class="btn btn-secondary btn-block">{{ $link->label }}</a>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $assets->appends($_GET)->render() !!}

    @endcomponent

@endsection

@section('scripts')
    @include('manage.asset.partials.scripts')
@endsection
