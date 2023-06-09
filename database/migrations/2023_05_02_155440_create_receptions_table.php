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
            $table->enum("status_reception",["in progress","valid","biased"])->default("in progress");
            $table->string("num_reception");
            $table->string("description_reception")->nullable();
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
            $table->dropColumn(["purchase_orders_id"]);
        });
        Schema::dropIfExists('receptions');
    }
};
