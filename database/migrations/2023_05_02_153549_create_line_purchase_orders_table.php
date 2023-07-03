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
        Schema::create('line_purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_purchase_order");
            $table->integer("qty_line_recept")->default(0);
            $table->integer("price_line_purchase_order");
            $table->integer("subtotal_line_purchase_order");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("purchase_orders_id")->constrained('purchase_orders');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_purchase_orders', function (Blueprint $table) {
            $table->dropColumn(["products_id","purchase_orders_id"]);
        });
        Schema::dropIfExists('line_purchase_orders');
    }
};
