<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('should_be_invoiced', ['Yes', 'No'])->default('No');
            $table->enum('mark_paid', ['Yes', 'No'])->default('No');
        
            $table->enum('convert_currency', ['Yes', 'No'])->default('No');
            $table->enum('inclusive_taxes', ['Yes', 'No'])->default('No');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
