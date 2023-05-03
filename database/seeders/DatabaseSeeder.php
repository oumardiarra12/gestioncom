<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LineCustomerOrder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategoryUserSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            CustomerOrderSeeder::class,
            LineCustomerOrderSeeder::class,
            DeliverySeeder::class,
            LineDeliverySeeder::class,
            CustomerInvoiceSeeder::class,
            LineCustomerInvoiceSeeder::class,
            CustomerPaymentSeeder::class,
            EstimateSeeder::class,
            LineEstimateSeeder::class,
            SupplierSeeder::class,
            PurchaseOrderSeeder::class,
            LinePurchaseOrderSeeder::class,
            ReceptionSeeder::class,
            LineReceptionSeeder::class,
            PurchaseInvoiceSeeder::class,
            LinePurchaseInvoiceSeeder::class,
            SupplierPaymentSeeder::class,
            ExpenseTypeSeeder::class,
            ExpenseSeeder::class
        ]);
    }
}
