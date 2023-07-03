<?php

namespace Database\Seeders;

use App\Models\Reception;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Reception::create([
               'status_reception' => 'non invoice',
               'num_reception' => $faker->numerify,
               'description_reception'=>$faker->text,
               'total_reception'=>$faker->numerify,
               'purchase_orders_id'=>$i,
               'users_id'=>1
           ]);
       }
    }
}
