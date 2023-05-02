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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string("num_deliveries");
            $table->enum("status_deliveries",["in progress","valid","dismiss"])->default("in progress");
            $table->string("description_deliveries")->nullable();
            $table->timestamps();
            $table->foreignId("customer_orders_id")->constrained('customer_orders');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn(["customer_orders_id"]);
        });
        Schema::dropIfExists('deliveries');
    }
};
