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
        Schema::create('customer_invoices', function (Blueprint $table) {
            $table->id();
            $table->enum("status_customer_invoices",["pay","no pay","partial pay"])->default("no pay");
            $table->string("num_customer_invoices");
            $table->integer("total_customer_invoices");
            $table->string("description_customer_invoices")->nullable();
            $table->foreignId("deliveries_id")->constrained('deliveries');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_invoices', function (Blueprint $table) {
            $table->dropColumn(["deliveries_id"]);
        });
        Schema::dropIfExists('customer_invoices');
    }
};
