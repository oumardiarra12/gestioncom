<?php

namespace Database\Seeders;

use App\Models\CategoryUser;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        CategoryUser::create([
            'name_category_users' => "admin",
            "description_category_users"=>$faker->text
        ]);
        CategoryUser::create([
            'name_category_users' => "gerant",
            "description_category_users"=>$faker->text
        ]);
        CategoryUser::create([
            'name_category_users' => "gestionnaire",
            "description_category_users"=>$faker->text
        ]);

    }
}
