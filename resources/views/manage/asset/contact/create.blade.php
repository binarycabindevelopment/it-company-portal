@extends('layouts.app')

@section('content')

    @include('components.breadcrumb',[
        'links' => [
            '/manage/asset' => 'Assets',
            '/manage/asset/'.$asset->id => $asset->name,
            '/manage/asset/'.$asset->id.'/contact/create' => 'Attach Contact',
        ],
    ])

    @component('components.panel',['title'=>'Attach Contact To '.$asset->name])
        {!! Former::open_vertical('/manage/asset/'.$asset->id.'/contact')->method('POST') !!}

        @component('components.panel',['title'=>'Link Existing Contact'])
            {!! Former::multiselect('contact_ids','Contacts')->options(\App\Options\Contact::get(null,['contactable_type'=>get_class($asset->assetable->facilityable),'contactable_id'=>$asset->assetable->id,'ignore'=>$asset->contacts]))->addClass('multiselect') !!}
            <button type="submit" class="btn btn-primary">Link Contact To This Asset</button>
        @endcomponent

        {!! Former::close() !!}
    @endcomponent

@endsection
