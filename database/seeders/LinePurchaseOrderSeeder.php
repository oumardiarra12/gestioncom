<?php

namespace Database\Seeders;

use App\Models\LinePurchaseOrder;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinePurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LinePurchaseOrder::create([
               'qty_line_purchase_order' => 10,
               'price_line_purchase_order' => $faker->randomDigitNotZero,
               'subtotal_line_purchase_order'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'purchase_orders_id'=>$i
           ]);
       }
    }
}
