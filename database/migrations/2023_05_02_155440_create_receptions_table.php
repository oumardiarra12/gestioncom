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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->enum("status_reception",["non invoice","to invoice"])->default("non invoice");
            $table->string("num_reception")->nullable();
            $table->string("description_reception")->nullable();
            $table->float("total_reception");
            $table->foreignId("users_id")->constrained('users');
            $table->foreignId("purchase_orders_id")->nullable()->constrained('purchase_orders');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receptions', function (Blueprint $table) {
            $table->dropColumn(["purchase_orders_id","users_id"]);
        });
        Schema::dropIfExists('receptions');
    }
};
