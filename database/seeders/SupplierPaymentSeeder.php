<?php

namespace Database\Seeders;

use App\Models\SupplierPayment;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           SupplierPayment::create([
               'amount_to_be_paid' => $faker->randomDigitNotZero,
               'amount_to_pay' => $faker->randomDigitNotZero,
               'reste'=>0,
               'description_supplier_payment'=>$faker->text,
               'purchase_invoices_id'=>$i,
               'users_id'=>1
           ]);
       }
    }
}
