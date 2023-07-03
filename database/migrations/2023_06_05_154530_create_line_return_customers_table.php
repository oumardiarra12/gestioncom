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
        Schema::create('line_return_customers', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_return_customer");
            $table->integer("price_return_customer");
            $table->integer("subtotal_return_customer");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("return_customers_id")->constrained('return_customers');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_return_customers', function (Blueprint $table) {
            $table->dropColumn(["products_id","return_customers_id"]);
        });
        Schema::dropIfExists('line_return_customers');
    }
};
