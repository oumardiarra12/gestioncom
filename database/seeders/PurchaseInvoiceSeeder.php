<?php

namespace Database\Seeders;

use App\Models\PurchaseInvoice;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           PurchaseInvoice::create([
               'status_purchase_invoice' => 'no pay',
               'num_purchase_invoice' => $faker->numerify,
               'total_purchase_invoice'=>$faker->randomDigitNotZero,
               'receptions_id'=>$i,
               'description_purchase_invoice'=>$faker->text
           ]);
       }
    }
}
