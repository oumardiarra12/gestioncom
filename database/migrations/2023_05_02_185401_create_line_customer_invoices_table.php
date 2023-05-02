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
        Schema::create('line_customer_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_customer_invoice");
           $table->integer("price_line_customer_invoice");
           $table->integer("subtotal_line_customer_invoice");
           $table->foreignId("products_id")->constrained('products');
           $table->foreignId("customer_invoices_id")->constrained('customer_invoices');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_customer_invoices', function (Blueprint $table) {
            $table->dropColumn(["products_id","customer_invoices_id"]);
        });
        Schema::dropIfExists('line_customer_invoices');
    }
};
