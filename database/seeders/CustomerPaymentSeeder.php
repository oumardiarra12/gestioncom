<?php

namespace Database\Seeders;

use App\Models\CustomerPayment;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           CustomerPayment::create([
               'amount_to_be_paid' => $faker->randomDigitNotZero,
               'amount_to_pay' => $faker->randomDigitNotZero,
               'reste'=>0,
               'description_customer_payment'=>$faker->text,
               'customer_invoices_id'=>$i
           ]);
       }
    }
}
