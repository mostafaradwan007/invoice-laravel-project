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
    Schema::create('quotes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->onDelete('cascade'); // links to clients
        $table->string('status')->default('Pending');
        $table->string('number')->unique();
        $table->decimal('amount', 10, 2);
        $table->date('date');
        $table->date('valid_until');
        $table->timestamps();
    });
}


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
