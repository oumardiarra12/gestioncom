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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("image_product");
            $table->string("ref_product");
            $table->string("codebarre_product");
            $table->string("name_product");
            $table->integer("stock_min");
            $table->integer("stock_actuel")->nullable();
            $table->string("description_product")->nullable();
            $table->foreignId("categories_id")->constrained('categories');
            $table->foreignId("units_id")->constrained('units');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(["categories_id","units_id"]);
        });
        Schema::dropIfExists('products');
    }
};
