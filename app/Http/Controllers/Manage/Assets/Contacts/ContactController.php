<?php

namespace App\Http\Controllers\Manage\Assets\Contacts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create($assetId){
        $asset = \App\Asset::findOrFail($assetId);
        return view('manage.asset.contact.create',[
            'asset'=>$asset,
        ]);
    }

    public function store(Request $request, $assetId){
        $asset = \App\Asset::findOrFail($assetId);
        if(!empty($request->contact_ids)){
            foreach($request->contact_ids as $contactId){
                \App\AssetContact::create([
                    'asset_id' => $asset->id,
                    'contact_id' => $contactId,
                ]);
            }
        }
        return redirect($asset->path())->withSuccess('Saved');
    }

    public function destroy($assetId, $contactId){
        $asset = \App\Asset::findOrFail($assetId);
        $assetContact = \App\AssetContact::where('asset_id',$assetId)->where('contact_id',$contactId)->first();
        if($assetContact){
            $assetContact->delete();
        }
        return redirect($asset->path())->withSuccess('Saved');
    }

}
