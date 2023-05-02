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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string("name_supplier");
            $table->string("tel_supplier");
            $table->string("address_supplier");
            $table->string("email_supplier")->nullable();
           $table->string("firstname_contact_supplier");
           $table->string("lastname_contact_supplier");
           $table->string("tel_contact_supplier");
           $table->string("email_contact_supplier")->nullable();
           $table->string("description_supplier")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
