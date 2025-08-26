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
        Schema::create('recurring_expenses', function (Blueprint $table) {
     $table->id();
   $table->foreignId('client_id')->constrained()->onDelete('cascade');
 $table->string('status')->nullable();
    $table->string('vendor')->nullable();

    $table->string('project')->nullable();
    $table->string('category')->nullable();
    $table->string('user')->nullable();
    $table->decimal('amount', 10, 2);
    $table->date('date');
    $table->string('frequency');
    $table->date('start_date');
    $table->string('remaining_cycle');
    $table->text(column: 'publicnotes')->nullable();
    $table->text('privatenotes')->nullable();
    $table->boolean('should_be_invoiced')->default(false);
    $table->boolean('mark_paid')->default(false);
    $table->boolean('convert_currency')->default(false);
    $table->boolean('add_documents')->default(false);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recurring_expenses');
    }
};
