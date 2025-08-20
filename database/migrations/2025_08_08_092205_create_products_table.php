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
    public function up(): void
    {
    Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->unsignedBigInteger('client_id'); // علاقة بـ clients فقط
    $table->date('due_date')->nullable();
    $table->decimal('budgeted_hours', 8, 2)->nullable();
    $table->decimal('task_rate', 10, 2)->nullable();
    $table->text('public_notes')->nullable();
    $table->text('private_notes')->nullable();
    $table->timestamps();

    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
});

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
