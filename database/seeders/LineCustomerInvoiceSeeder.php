<?php

namespace Database\Seeders;

use App\Models\LineCustomerInvoice;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineCustomerInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineCustomerInvoice::create([
               'qty_line_customer_invoice' => 10,
               'price_line_customer_invoice' => $faker->randomDigitNotZero,
               'subtotal_line_customer_invoice'=> $faker->randomDigitNotZero,
               'products_id'=>$i,
               'customer_invoices_id'=>$i
           ]);
       }
    }
}
