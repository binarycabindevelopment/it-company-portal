<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 20;
        $currentModelsCount = \App\Event::all()->count();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $event = factory(\App\Event::class)->create();
            }
        }
    }
}
