<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Delivery::create([
               'num_deliveries' => $faker->numerify,
               'status_deliveries' => "no invoice",
               'description_deliveries'=>$faker->text,
               'customer_orders_id'=>$i
           ]);
       }
    }
}
