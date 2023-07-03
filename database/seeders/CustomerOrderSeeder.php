<?php

namespace Database\Seeders;

use App\Models\CustomerOrder;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           CustomerOrder::create([
            "num_customer_order" => $faker->numerify,
            "status_customer_order" => "in progress",
            "description_customer_order"=>$faker->text,
            "total_customer_order"=>$faker->randomDigitNotNull,
            "customers_id"=>$i,
            "users_id"=>1
           ]);
       }
    }
}
