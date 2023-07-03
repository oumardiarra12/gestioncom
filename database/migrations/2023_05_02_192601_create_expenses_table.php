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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string("number_expense")->nullable();
            $table->string("reason");
            $table->integer("amount");
            $table->string("description_expense");
            $table->timestamps();
            $table->foreignId("expense_types_id")->constrained('expense_types');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn(["expense_types_id"]);
        });
        Schema::dropIfExists('expenses');
    }
};
