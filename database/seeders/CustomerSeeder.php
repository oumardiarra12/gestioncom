<?php

namespace Database\Seeders;

use App\Models\Customer;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Customer::create([
            "firstname_customer" => $faker->firstName,
            "lastname_customer" => $faker->lastName,
            "tel_customer"=>$faker->phoneNumber,
            "email_customer"=>$faker->email,
            "address_customer"=>$faker->address,
            "description_customer"=>$faker->text
           ]);
       }
    }
}
