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
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->id();
            $table->enum("status_purchase_invoice",["pay","no pay","partial pay"])->default("no pay");
            $table->string("num_purchase_invoice");
            $table->integer("total_purchase_invoice");
            $table->string("description_purchase_invoice")->nullable();
            $table->foreignId("receptions_id")->constrained('receptions');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('purchase_invoices', function (Blueprint $table) {
            $table->dropColumn(["receptions_id"]);
        });
        Schema::dropIfExists('purchase_invoices');
    }
};
