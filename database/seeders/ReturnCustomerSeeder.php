<?php

namespace Database\Seeders;

use App\Models\ReturnCustomer;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReturnCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          ReturnCustomer::create([
               'num_return_customer' => $faker->numerify,
               'description_return_customer'=>$faker->text,
               'customers_id'=>$i,
               'total_return_customer'=>$faker->randomDigitNotZero,
               'users_id'=>1
           ]);
       }
    }
}
