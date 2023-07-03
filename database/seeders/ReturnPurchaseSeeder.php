<?php

namespace Database\Seeders;

use App\Models\ReturnPurchase;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReturnPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          ReturnPurchase::create([
               'num_return_purchase' => $faker->numerify,
               'description_return_purchase'=>$faker->text,
               'suppliers_id'=>$i,
               'total_return_purchase'=>$faker->randomDigitNotZero,
               'users_id'=>1
           ]);
       }
    }
}
