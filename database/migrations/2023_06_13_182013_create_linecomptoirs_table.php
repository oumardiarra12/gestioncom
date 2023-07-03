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
        Schema::create('linecomptoirs', function (Blueprint $table) {
            $table->id();
            $table->integer("qty_linecomptoir");
            $table->integer("price_linecomptoir");
            $table->integer("subtotal_linecomptoir");
            $table->foreignId("products_id")->constrained('products');
            $table->foreignId("comptoirs_id")->constrained('comptoirs');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('linecomptoirs', function (Blueprint $table) {
            $table->dropColumn(["products_id","comptoirs_id"]);
        });
        Schema::dropIfExists('linecomptoirs');
    }
};
