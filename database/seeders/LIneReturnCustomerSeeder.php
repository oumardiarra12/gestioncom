<?php

namespace Database\Seeders;

use App\Models\LineReturnCustomer;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LIneReturnCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineReturnCustomer::create([
               'qty_line_return_customer' => 10,
               'price_return_customer' => $faker->randomDigitNotZero,
               'subtotal_return_customer'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'return_customers_id'=>$i
           ]);
       }
    }
}
