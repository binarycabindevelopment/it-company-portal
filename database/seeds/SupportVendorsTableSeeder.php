<?php

use Illuminate\Database\Seeder;

class SupportVendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 20;
        $currentModelsCount = \App\SupportVendor::all()->count();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $model = factory(\App\SupportVendor::class)->create();
            }

        }
    }
}
