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
        Schema::create('task_settings', function (Blueprint $table) {
            $table->id();

    $table->string(column: 'currency')->nullable();
            $table->decimal('default_task_rate')->nullable();

                   $table->enum('auto_start_task', ['Yes', 'No'])->default('No');
            $table->enum('show_task_end_date', ['Yes', 'No'])->default('No');
            $table->enum('task_document', ['Yes', 'No'])->default('No');

            $table->enum('show_project_on_tasks', ['Yes', 'No'])->default('No');

                $table->string('round_to_nearest')->nullable();
            $table->string('default_task_type')->nullable();

            $table->enum('lock_invoiced_tasks', ['Yes', 'No'])->default('No');



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
        Schema::dropIfExists('task_settings');
    }
};
