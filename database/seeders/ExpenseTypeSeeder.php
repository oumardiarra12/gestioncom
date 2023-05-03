<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           ExpenseType::create([
               'name_expense_types' => $faker->name,
               'description_expense_types' => $faker->text,
           ]);
       }
    }
}
