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
        Schema::create('line_receptions', function (Blueprint $table) {
            $table->id();
           $table->integer("qty_line_reception");
           $table->integer("qty_recu_line_reception");
           $table->foreignId("products_id")->constrained('products');
           $table->foreignId("receptions_id")->constrained('receptions');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('line_receptions', function (Blueprint $table) {
            $table->dropColumn(["products_id","receptions_id"]);
        });
        Schema::dropIfExists('line__receptions');
    }
};
