<?php

use Illuminate\Database\Seeder;

class CredentialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 15;
        $currentModelsCount = \App\Credential::all()->count();
        $adminUsers = \App\User::where('role','admin')->get();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $user = $adminUsers->random();
                $model = factory(\App\Credential::class)->create([
                    'author_user_id' => $user->id,
                ]);
            }
        }
    }
}
