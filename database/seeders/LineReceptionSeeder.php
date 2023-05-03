<?php

namespace Database\Seeders;

use App\Models\LineReception;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LineReceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           LineReception::create([
               'qty_line_reception' => 10,
               'qty_recu_line_reception' => 5,
               'products_id'=>$i,
               'receptions_id'=>$i
           ]);
       }
    }
}
