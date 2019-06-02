@component('components.panel',[
    'title'=>$slot,
    'headerTextColorClass'=>'text-dark',
    'headerTextBGClass'=>'bg-light',
    'additionalClasses'=>'mb-2',
    ])

    <div class="image-container">
        <div class="row">
            <div class="col-sm-6">
                {!! Former::file('image_file','') !!}
            </div>
            <div class="col-sm-6 text-right">
                @if(isset($image))
                    <img src="{{ $image->fileUrl() }}" width="200" />
                @endif
            </div>
        </div>
    </div>

@endcomponent