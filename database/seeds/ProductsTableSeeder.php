<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $requiredModels = 30;
        $currentModelsCount = \App\Product::all()->count();
        if ($currentModelsCount < $requiredModels) {
            for($productIndex =0; $productIndex< $requiredModels; $productIndex++){
                 $factory = factory(\App\Product::class)->create();
            }
        }
    }
}
