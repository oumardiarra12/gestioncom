<?php

namespace Database\Seeders;

use App\Models\LineCustomerOrder;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineCustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineCustomerOrder::create([
               'qty_line_customer_order' => 10,
               'price_line_customer_order' => $faker->randomDigitNotZero,
               "subtotal_line_customer_order"=>$faker->randomDigitNotZero,
               "products_id"=>$i,
               "customer_orders_id"=>$i
           ]);
       }
    }
}
