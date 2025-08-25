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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            //company details
            $table->string('industry')->nullable();
            $table->string('classification')->nullable();
            $table->string('email')->nullable();
          $table->string('companyPhone')->nullable();
$table->string('IDnumber')->nullable();
$table->string('VATnumber')->nullable();

            $table->string('companyname')->nullable();
            $table->string('website')->nullable();


            //address
            $table->string('street_address')->nullable();
            $table->string('apt_suite')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
$table->string('state_province')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
