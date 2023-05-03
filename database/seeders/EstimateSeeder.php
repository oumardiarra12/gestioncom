<?php

namespace Database\Seeders;

use App\Models\Estimate;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstimateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Estimate::create([
               'num_estimates' => $faker->numerify,
               'status_estimates' => 'in progress',
               'description_estimates'=>$faker->text,
               'customers_id'=>$i
           ]);
       }
    }
}
