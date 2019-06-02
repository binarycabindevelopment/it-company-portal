<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 20;
        $currentModelsCount = \App\Vehicle::all()->count();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $vehicle = factory(\App\Vehicle::class)->create();
            }
        }
    }
}
