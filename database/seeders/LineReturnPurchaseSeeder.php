<?php

namespace Database\Seeders;

use App\Models\LineReturnPurchase;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineReturnPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineReturnPurchase::create([
               'qty_line_return_purchase' => 10,
               'price_return_purchase' => $faker->randomDigitNotZero,
               'subtotal_return_purchase'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'return_purchases_id'=>$i
           ]);
       }
    }
}
