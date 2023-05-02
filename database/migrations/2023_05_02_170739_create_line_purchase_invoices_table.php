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
        Schema::create('line_purchase_invoices', function (Blueprint $table) {
            $table->id();
           $table->integer("qty_line_purchase_invoice");
           $table->integer("price_purchase_invoice");
           $table->integer("subtotal_purchase_invoice");
           $table->foreignId("products_id")->constrained('products');
           $table->foreignId("purchase_invoices_id")->constrained('purchase_invoices');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_purchase_invoices', function (Blueprint $table) {
            $table->dropColumn(["products_id","purchase_invoices_id"]);
        });
        Schema::dropIfExists('line_purchase_invoices');
    }
};
