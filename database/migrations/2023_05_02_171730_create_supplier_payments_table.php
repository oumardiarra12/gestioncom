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
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->id();
            $table->integer("amount_to_be_paid");
            $table->integer("amount_to_pay");
            $table->integer("reste");
            $table->string("description_supplier_payment")->nullable();
            $table->foreignId("purchase_invoices_id")->constrained('purchase_invoices');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_payments', function (Blueprint $table) {
            $table->dropColumn(["purchase_invoices_id"]);
        });
        Schema::dropIfExists('supplier_payments');
    }
};
