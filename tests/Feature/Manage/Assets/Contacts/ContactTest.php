<?php

namespace Tests\Feature\Manage\Assets\Contacts;

use Tests\AppTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends AppTestCase
{

    use RefreshDatabase;

    public function test_require_permissions(){
        $auth = $this->newUser([
            'role' => 'authenticated',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $response = $this->actingAs($auth)->get($asset->path('contact/create'));
        $response->assertRedirect('/account');
    }

    public function test_create(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $asset = factory(\App\Asset::class)->create();
        $response = $this->actingAs($auth)->get($asset->path('contact/create'));
        $response->assertStatus(200);
    }

    public function test_store(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $facility = factory(\App\Facility::class)->create();
        $asset = factory(\App\Asset::class)->create([
            'assetable_id' => $facility->id,
            'assetable_type' => get_class($facility),
        ]);
        $contact = factory(\App\Contact::class)->create([
            'contactable_id' => $facility->facilityable->id,
            'contactable_type' => get_class($facility->facilityable),
        ]);
        $linkedContact = factory(\App\LinkedContact::class)->create([
            'contactable_id' => $facility->id,
            'contactable_type' => get_class($facility),
            'contact_id' => $contact->id,
        ]);
        $response = $this->actingAs($auth)->post($asset->path('contact'),[
            'contact_ids' => [$contact->id],
        ]);
        $assetContact = \App\AssetContact::where('contact_id',$contact->id)->where('asset_id',$asset->id)->first();
        $response->assertRedirect($asset->path());
        $this->assertNotNull($assetContact);
        $asset = $asset->fresh();
        $this->assertEquals(1, $asset->contacts->count());
    }

    public function test_delete(){
        $auth = $this->newUser([
            'role' => 'admin',
        ]);
        $facility = factory(\App\Facility::class)->create();
        $asset = factory(\App\Asset::class)->create([
            'assetable_id' => $facility->id,
            'assetable_type' => get_class($facility),
        ]);
        $contact = factory(\App\Contact::class)->create([
            'contactable_id' => $facility->facilityable->id,
            'contactable_type' => get_class($facility->facilityable),
        ]);
        $linkedContact = factory(\App\LinkedContact::class)->create([
            'contactable_id' => $facility->id,
            'contactable_type' => get_class($facility),
            'contact_id' => $contact->id,
        ]);
        $assetContact = factory(\App\AssetContact::class)->create([
            'contact_id' => $contact->id,
            'asset_id' => $asset->id,
        ]);
        $response = $this->actingAs($auth)->delete($asset->path('contact/'.$contact->id));
        $response->assertRedirect($asset->path());
        $existingContact = \App\Contact::find($contact->id);
        $existingAssetContact = \App\AssetContact::find($contact->id);
        $this->assertNotNull($existingContact);
        $this->assertNull($existingAssetContact);
    }

}
