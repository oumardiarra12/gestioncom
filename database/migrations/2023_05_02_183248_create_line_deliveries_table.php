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
        Schema::create('line_deliveries', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_order");
            $table->integer("qty_line_deliverie");
            $table->integer("price_line_deliverie");
            $table->integer("subtotal_line_deliverie");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("deliveries_id")->constrained('deliveries');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_deliveries', function (Blueprint $table) {
            $table->dropColumn(["products_id","deliveries_id"]);
        });
        Schema::dropIfExists('line_deliveries');
    }
};
