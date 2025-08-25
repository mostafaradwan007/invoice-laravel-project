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
        Schema::create('product_settings', function (Blueprint $table) {
            $table->id();

                  $table->enum('track_inventory', ['Yes', 'No'])->default('No');
            $table->enum('stock_notifications', ['Yes', 'No'])->default('No');
               $table->enum('convert_products', ['Yes', 'No'])->default('No');
            $table->enum('auto_update_products', ['Yes', 'No'])->default('No');
            $table->enum('auto_fill_products', ['Yes', 'No'])->default('No');
            $table->enum('default_quantity', ['Yes', 'No'])->default('No');
            $table->enum('show_products_quantity', ['Yes', 'No'])->default('No');

            $table->enum('show_products_cost', ['Yes', 'No'])->default('No');
            $table->enum('show_products', ['Yes', 'No'])->default('No');

            $table->string('notification_threshold')->nullable();

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
        Schema::dropIfExists('product_settings');
    }
};
