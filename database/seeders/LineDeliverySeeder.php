<?php

namespace Database\Seeders;

use App\Models\LineDelivery;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineDelivery::create([
               'qty_line_deliverie' => 10,
               'price_line_deliverie' => $faker->randomDigitNotZero,
               'subtotal_line_deliverie'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'deliveries_id'=>$i
           ]);
       }
    }
}
