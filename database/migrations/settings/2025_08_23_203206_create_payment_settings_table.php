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
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->enum('standard_invoices', ['Yes', 'No'])->default('No');
            $table->enum('recurring_invoices', ['Yes', 'No'])->default('No');
            $table->enum('use_available_credits', ['Yes', 'No'])->default('No');
            $table->enum('use_unapplied_payments', ['Yes', 'No'])->default('No');
            $table->enum('manual_payment_email', ['Yes', 'No'])->default('No');
            $table->enum('online_payment_email', ['Yes', 'No'])->default('No');
            $table->enum('mark_paid_payment_email', ['Yes', 'No'])->default('No');

            $table->enum('payment_email_to_all_contacts', ['Yes', 'No'])->default('No');
            $table->enum('manual_overpayments', ['Yes', 'No'])->default('No');
            $table->enum('allow_overpayment', ['Yes', 'No'])->default('No');
            $table->enum('allow_underpayment', ['Yes', 'No'])->default('No');
            $table->enum('client_initiated_payments', ['Yes', 'No'])->default('No');

            $table->enum('one_page_checkout', ['Yes', 'No'])->default('No');
            $table->enum('unlock_documents', ['Yes', 'No'])->default('No');

            $table->string('payment_type')->nullable();
            $table->decimal('quote_valid_until')->nullable();
            $table->string(column: 'auto_bill_on')->nullable();
            $table->string(column: 'expense_payment_type')->nullable();

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
        Schema::dropIfExists('payment_settings');
    }
};
