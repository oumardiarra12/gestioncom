<?php

namespace Database\Seeders;

use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('fr_FR');
        Company::create([
            "company_name"=>$faker->name,
            "company_sigle"=>"SDTCH",
            "company_status"=>"Informatique",
            "company_nif"=>$faker->randomDigitNotNull,
            "company_logo"=>"companylogo.jpg",
            "company_contact"=>$faker->phoneNumber,
            "company_email"=>$faker->email,
            "company_bp"=>$faker->numerify,
            "company_fax"=>$faker->phoneNumber,
            "company_address"=>$faker->address,
            "company_activity"=>"Informatique"
        ]);
    }
}
