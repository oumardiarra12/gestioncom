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
        Schema::create('return_customers', function (Blueprint $table) {
            $table->id();
            $table->string("num_return_customer")->nullable();
            $table->string("description_return_customer")->nullable();
            $table->float("total_return_customer");
            $table->foreignId("users_id")->constrained('users');
            $table->foreignId("customers_id")->constrained('customers');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('return_customers', function (Blueprint $table) {
            $table->dropColumn(["customers_id","users_id"]);
        });
        Schema::dropIfExists('return_customers');
    }
};
