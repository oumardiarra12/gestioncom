<?php

namespace Database\Seeders;

use App\Models\LinePurchaseInvoice;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LinePurchaseInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LinePurchaseInvoice::create([
               'qty_line_purchase_invoice' => 10,
               'price_purchase_invoice' => $faker->randomDigitNotZero,
               'subtotal_purchase_invoice'=>$faker->randomDigitNotZero,
               'products_id'=>$i,
               'purchase_invoices_id'=>$i
           ]);
       }
    }
}