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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_sigle');
            $table->string('company_status')->nullable();
            $table->string('company_nif')->nullable();
            $table->string('company_logo');
            $table->string('company_contact')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_bp')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_address');
            $table->string('company_activity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
