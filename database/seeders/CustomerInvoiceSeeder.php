<?php

namespace Database\Seeders;

use App\Models\CustomerInvoice;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           CustomerInvoice::create([
               'status_customer_invoices' => 'no pay',
               'num_customer_invoices' => $faker->numerify,
               'total_customer_invoices'=>$faker->randomDigitNotZero,
               'deliveries_id'=>$i,
               'description_customer_invoices'=>$faker->text
           ]);
       }
    }
}
