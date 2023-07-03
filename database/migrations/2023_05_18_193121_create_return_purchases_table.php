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
        Schema::create('return_purchases', function (Blueprint $table) {
            $table->id();
            $table->string("num_return_purchase")->nullable();
            $table->string("description_return_purchase")->nullable();
            $table->float("total_return_purchase");
            $table->foreignId("users_id")->constrained('users');
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
        Schema::table('return_purchases', function (Blueprint $table) {
            $table->dropColumn(["suppliers_id","users_id"]);
        });
        Schema::dropIfExists('return_purchases');
    }
};
