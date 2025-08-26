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
        Schema::create('account_managment', function (Blueprint $table) {
            $table->id();

            //overview
            $table->enum('activate_company', ['Yes', 'No'])->default('No');
            $table->enum('enable_markdown', ['Yes', 'No'])->default('No');
            $table->enum('include_drafts', ['Yes', 'No'])->default('No');

//enabled modules
            $table->enum('invoices', ['Yes', 'No'])->default('No');
            $table->enum('recurring_invoices', ['Yes', 'No'])->default('No');
            $table->enum('quotes', ['Yes', 'No'])->default('No');
            $table->enum('credits', ['Yes', 'No'])->default('No');
            $table->enum('projects', ['Yes', 'No'])->default('No');
            $table->enum('tasks', ['Yes', 'No'])->default('No');
            $table->enum('vendors', ['Yes', 'No'])->default('No');
            $table->enum('expenses', ['Yes', 'No'])->default('No');
            $table->enum('purchase_orders', ['Yes', 'No'])->default('No');
            $table->enum('recurring_expenses', ['Yes', 'No'])->default('No');
            $table->enum('transactions', ['Yes', 'No'])->default('No');

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
        Schema::dropIfExists('account_managment');
    }
};
