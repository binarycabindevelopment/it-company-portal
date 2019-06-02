<?php

use Illuminate\Database\Seeder;

class LinkedFacilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 15;
        $currentModelsCount = \App\LinkedFacility::all()->count();
        if($currentModelsCount < $requiredModels) {
            for ($i = 0; $i < $requiredModels; $i++) {
                $numberOfFacility = rand(0, 2);
                for ($facilityIndex = 0; $facilityIndex < $numberOfFacility; $facilityIndex++) {
                    $linkFacility = factory(\App\LinkedFacility::class)->create();
                }
            }
        }
    }
}
