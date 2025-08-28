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
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // links to clients
            $table->string('status')->default('Pending');
            $table->string('number')->unique();
            $table->decimal('amount', 10, 2);
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->date('date');
            $table->date('valid_until');
            $table->date('credit_date')->default(now());
            $table->date('due_date')->nullable();
            $table->decimal('partial_deposit', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->enum('discount_type', ['amount', 'percent'])->default('amount');
            $table->string('po_number')->nullable();
            $table->text('public_notes')->nullable();
            $table->text('private_notes')->nullable();
            $table->text('terms')->nullable();
            $table->text('footer')->nullable();
            $table->json('items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
