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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->enum("stats_purchase_order",["in progress","valid","dismiss"])->default("in progress");
            $table->string("num_purchase_order");
            $table->string("description_purchase_order")->nullable();
            $table->float("total_purchase_order");
            $table->foreignId("suppliers_id")->constrained('suppliers');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_orders', function (Blueprint $table) {
            $table->dropColumn(["suppliers_id"]);
        });
        Schema::dropIfExists('purchase_orders');
    }
};
