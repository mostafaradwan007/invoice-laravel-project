<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');                               // Project Name
            $table->foreignId('client_id')->constrained()->onDelete('cascade'); // Client
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // User
            $table->date('due_date')->nullable();                 // Due Date
            $table->integer('budgeted_hours')->nullable();        // Budgeted Hours
            $table->decimal('task_rate', 10, 2)->nullable();      // Task Rate
            $table->text('public_notes')->nullable();             // Public Notes
            $table->text('private_notes')->nullable();            // Private Notes
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
