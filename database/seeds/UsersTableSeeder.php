<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 60;
        $currentModelsCount = \App\User::all()->count();
        if($currentModelsCount < $requiredModels){
            for($i=0;$i<$requiredModels;$i++){
                $user = factory(\App\User::class)->create();
            }

        }
        $roles = \App\Options\Role::get();
        foreach($roles as $roleKey => $role){
            $email = $roleKey.'@'.$roleKey.'.com';
            $existingModel = \App\User::where('email',$email)->first();
            if(!$existingModel){
                $model = factory(\App\User::class)->create([
                    'email' => $email,
                    'role' => $roleKey,
                    'password' => \Hash::make($roleKey),
                ]);
            }
            if($roleKey == 'customer'){
                $user = \App\User::where('email',$email)->first();
                $customer = factory(\App\Customer::class)->create();
                $contact = factory(\App\Contact::class)->create([
                    'contactable_id' => $customer->id,
                    'contactable_type' => get_class($customer),
                ]);
                $linkedUser = factory(\App\LinkedUser::class)->create([
                    'userable_id' => $contact->id,
                    'userable_type' => get_class($contact),
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
