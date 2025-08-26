<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();         // PMT-000001
            $table->string('client_name');
            $table->decimal('amount', 12, 2)->default(0);
            $table->string('invoice_number')->nullable();
            $table->date('payment_date');
            $table->string('payment_type')->nullable();         // Cash, Bank Transfer, Card...
            $table->string('transaction_reference')->nullable();// transaction id/reference
            $table->string('status')->default('paid');          // paid/pending/overdue/etc
            $table->text('private_notes')->nullable();
            $table->boolean('send_email')->default(true);
            $table->boolean('convert_currency')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

