<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Product::create([
            "ref_product"=>$faker->numerify,
            "codebarre_product"=>$faker->numerify,
               'image_product' => $faker->imageUrl,
               'name_product' => $faker->name,
               "stock_min"=>20,
               "stock_actuel"=>200,
               "categories_id"=>$i,
               "units_id"=>1
           ]);
       }
    }
}
