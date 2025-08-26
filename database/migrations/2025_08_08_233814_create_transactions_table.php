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
    Schema::create('transactions', function (Blueprint $table) {
                  $table->id();

            $table->string('status')->nullable();
            $table->decimal('deposit', 10, 2)->nullable();
            $table->decimal('withdrawal', 10, 2)->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->string('bank_account')->nullable();
            $table->decimal('amount')->nullable();

            $table->timestamps();

    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
