<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->id();
            $table->integer("amount_to_be_paid");
            $table->integer("amount_to_pay");
            $table->integer("reste");
            $table->string("description_customer_payment")->nullable();
            $table->foreignId("customer_invoices_id")->constrained('customer_invoices');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_payments', function (Blueprint $table) {
            $table->dropColumn(["customer_invoices_id"]);
        });
        Schema::dropIfExists('customer_payments');
    }
};
