<?php

namespace Database\Seeders;

use App\Models\linecomptoir;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineComptoirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           linecomptoir::create([
               'qty_linecomptoir' => 10,
               'price_linecomptoir' => $faker->randomDigitNotZero,
               'subtotal_linecomptoir'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'comptoirs_id'=>$i
           ]);
       }
    }
}
