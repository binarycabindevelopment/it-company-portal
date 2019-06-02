<?php

use Illuminate\Database\Seeder;

class MonitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 15;
        $currentModelsCount = \App\Monitor::all()->count();
        $adminUsers = \App\User::where('role','admin')->get();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $user = $adminUsers->random();
                $model = factory(\App\Monitor::class)->create([
                    'author_user_id' => $user->id,
                ]);
            }
        }
    }
}
