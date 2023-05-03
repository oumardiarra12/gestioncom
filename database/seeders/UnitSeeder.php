<?php

namespace Database\Seeders;

use App\Models\Unit;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        Unit::create([
            'name_unit' => "carton",
            "description_unit"=>$faker->text
        ]);
        Unit::create([
            'name_unit' => "pot",
            "description_unit"=>$faker->text
        ]);
        Unit::create([
            'name_unit' => "boite",
            "description_unit"=>$faker->text
        ]);
    }
}
