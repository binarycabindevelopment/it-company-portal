@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="logo-container">
        <div class="row">
            <div class="col-sm-6">
                {!! Former::file('logo_file','') !!}
            </div>
            <div class="col-sm-6 text-right">
                @if(isset($logo))
                    <img src="{{ $logo->fileUrl() }}" width="200" />
                @endif
            </div>
        </div>
    </div>

@endcomponent