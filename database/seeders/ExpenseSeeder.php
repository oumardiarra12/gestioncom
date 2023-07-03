<?php

namespace Database\Seeders;

use App\Models\Expense;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
          Expense::create([
               'reason' => $faker->name,
            //    'number_expense' => $faker->randomDigitNotZero,
               'amount' => $faker->randomDigitNotZero,
               'expense_types_id'=>$i,
               "description_expense"=>$faker->text
           ]);
       }
    }
}
