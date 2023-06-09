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
        Schema::create('line_estimates', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_line_estimate");
            $table->integer("price_line_estimate");
            $table->integer("subtotal_line_estimate");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("estimates_id")->constrained('estimates');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_estimates', function (Blueprint $table) {
            $table->dropColumn(["products_id","estimates_id"]);
        });
        Schema::dropIfExists('line_estimates');
    }
};
