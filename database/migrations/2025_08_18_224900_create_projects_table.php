<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); // BIGINT UNSIGNED auto increment
            $table->string('name'); // project name
            $table->text('description')->nullable(); // optional description
            $table->foreignId('client_id') // relation to clients table
                  ->nullable()
                  ->constrained('clients')
                  ->nullOnDelete(); 
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
