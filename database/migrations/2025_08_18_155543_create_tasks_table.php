<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
    
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable()->unique();
            $table->text('description');
            $table->string('duration')->nullable(); // e.g., "1:30"
            $table->date('task_date')->nullable();
            $table->string('status')->default('Logged'); // e.g., Logged, Running, Invoiced

            // Foreign keys for ( clients and projects tables)
            $table->foreignId('client_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('set null'); 
            
            $table->timestamps();
        });
    }
    
    
};
