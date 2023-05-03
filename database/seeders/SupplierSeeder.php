<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=1; $i <= 10 ; $i++) {
           Supplier::create([
               'name_supplier' => $faker->name,
               'tel_supplier'=>$faker->phoneNumber,
               'address_supplier'=>$faker->address,
               'email_supplier'=>$faker->email,
               'firstname_contact_supplier'=>$faker->firstName,
               'lastname_contact_supplier'=>$faker->lastName,
               'tel_contact_supplier'=>$faker->phoneNumber,
               'email_contact_supplier'=>$faker->email,
               'description_supplier' => $faker->text,
           ]);
       }
    }
}
