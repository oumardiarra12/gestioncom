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
        Schema::create('line_customer_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_customer_order");
            $table->integer("qty_line_delivery")->default(0);
            $table->integer("price_line_customer_order");
            $table->integer("subtotal_line_customer_order");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("customer_orders_id")->constrained('customer_orders');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_customer_orders', function (Blueprint $table) {
            $table->dropColumn(["products_id","customer_orders_id"]);
        });
        Schema::dropIfExists('line_customer_orders');
    }
};
