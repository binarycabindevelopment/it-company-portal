<?php

use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 50;
        $currentModelsCount = \App\Asset::all()->count();
        $facilities = \App\Facility::all();
        $adminUsers = \App\User::where('role','admin')->get();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $facility = $facilities->random();
                $user = $adminUsers->random();
                $model = factory(\App\Asset::class)->create([
                    'author_user_id' => $user->id,
                    'assetable_id' => $facility->id,
                    'assetable_type' => get_class($facility),
                ]);
                foreach($facility->contacts as $contact){
                    $chanceOfAddingContact = rand(0,100);
                    if($chanceOfAddingContact < 80){
                        $assetContact = factory(\App\AssetContact::class)->create([
                            'asset_id' => $model->id,
                            'contact_id' => $contact->id,
                        ]);
                    }
                }
                $numberOfLinks = rand(0,2);
                for($linkIndex=0;$linkIndex<$numberOfLinks;$linkIndex++){
                    $link = factory(\App\Link::class)->create([
                        'linkable_id' => $model->id,
                        'linkable_type' => get_class($model),
                    ]);
                }
                if($facility->maps->count() > 0){
                    $chanceOfLinkingToAMap = rand(0,100);
                    if($chanceOfLinkingToAMap < 90){
                        $linkedMap = factory(\App\LinkedMap::class)->create([
                            'mappable_id' => $model->id,
                            'mappable_type' => get_class($model),
                            'map_id' => $facility->maps->random()->id,
                        ]);
                    }
                }
            }
        }
    }
}
