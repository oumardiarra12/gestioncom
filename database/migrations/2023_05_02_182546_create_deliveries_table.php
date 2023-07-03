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
            $table->string("num_deliveries")->nullable();
            $table->enum("status_deliveries",["no invoice","to invoice"])->default("no invoice");
            $table->string("description_deliveries")->nullable();
            $table->timestamps();
            $table->float("total_deliveries");
            $table->foreignId("users_id")->constrained('users');
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
            $table->dropColumn(["customer_orders_id","users_id"]);
        });
        Schema::dropIfExists('deliveries');
    }
};
