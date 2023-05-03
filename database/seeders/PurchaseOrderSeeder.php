<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           PurchaseOrder::create([
               'stats_purchase_order' => 'in progress',
               'num_purchase_order' => $faker->numerify,
               'description_purchase_order'=>$faker->text,
               'suppliers_id'=>$i,
               'total_purchase_order'=>$faker->randomDigitNotZero
           ]);
       }
    }
}
