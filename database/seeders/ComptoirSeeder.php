<?php

namespace Database\Seeders;

use App\Models\comptoir;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComptoirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           comptoir::create([
               'num_comptoir' => $faker->numerify,
               "total_comptoir"=>$faker->randomDigitNotNull,
               'customers_id'=>$i,
               "users_id"=>1
           ]);
       }
    }
}
