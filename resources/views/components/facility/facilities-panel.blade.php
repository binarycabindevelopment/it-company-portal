@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    @slot('action')
        <a href="{{ url($basePath.'/create') }}" class="btn btn-primary btn-sm">Add</a>
    @endslot

    @foreach($facilities as $facility)
        <div class="card mb-2">
            <div class="card-header">
                <p class="card-title">{{ $facility->name }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        @if($facility->image)
                            <p><img src="{{ $facility->image->fileUrl() }}" class="img-fluid"/></p>
                        @endif
                    </div>
                    <div class="col-8">
                        <p><a href="{{ url($facility->path()) }}" class="btn btn-block btn-info">View</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endcomponent