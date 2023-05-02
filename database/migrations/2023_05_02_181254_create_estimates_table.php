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
        Schema::create('estimates', function (Blueprint $table) {
            $table->id();
            $table->string("num_estimates");
            $table->enum("status_estimates",["in progress","valid","dismiss"])->default("in progress");
            $table->string("description_estimates")->nullable();
            $table->timestamps();
            $table->foreignId("customers_id")->constrained('customers');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estimates', function (Blueprint $table) {
            $table->dropColumn(["customers_id"]);
        });
        Schema::dropIfExists('estimates');
    }
};
