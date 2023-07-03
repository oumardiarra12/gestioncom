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
        Schema::create('line_return_purchases', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_return_purchase");
           $table->integer("price_return_purchase");
           $table->integer("subtotal_return_purchase");
           $table->foreignId("products_id")->constrained('products');
           $table->foreignId("return_purchases_id")->constrained('return_purchases');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_return_purchases', function (Blueprint $table) {
            $table->dropColumn(["products_id","return_purchases_id"]);
        });
        Schema::dropIfExists('line_return_purchases');
    }
};
