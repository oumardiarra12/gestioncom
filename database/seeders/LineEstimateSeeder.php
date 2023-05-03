<?php

namespace Database\Seeders;

use App\Models\LineEstimate;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineEstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineEstimate::create([
               'qty_line_estimate' => 10,
               'price_line_estimate' => $faker->randomDigitNotZero,
               'subtotal_line_estimate'=> $faker->randomDigitNotZero,
               'products_id'=>$i,
               'estimates_id'=>$i
           ]);
       }
    }
}
