<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        User::create([
            'firstname' => $faker->firstName,
            'lastname' => $faker->lastName,
            'telephone' => $faker->phoneNumber,
            'email' => 'admin@test.ml',
            'image' => 'userdefault.jpg',
            'addresse'=>$faker->text,
            'password' => Hash::make('Bamako123'),
            'category_users_id'=>1
        ]);
        for ($i=2; $i <= 5 ; $i++) {
            User::create([
               'firstname' => $faker->firstName,
               'lastname' => $faker->lastName,
               'telephone' => $faker->phoneNumber,
               'addresse'=>$faker->text,
               'email' => 'test@test'.$i.'.ml',
               'image' => 'userdefault.jpg',
               'password' => Hash::make('Bamako123'),
               'category_users_id'=>2
           ]);
       }
    }
}
