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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable();
        $table->string('number')->nullable();
        $table->string('group')->nullable();
        $table->string('user')->nullable();
        $table->string('id_number')->nullable();
        $table->string('vat_number')->nullable();
        $table->string('website')->nullable();
        $table->string('phone')->nullable();
        $table->string('routing_id')->nullable();
        $table->boolean('valid_vat')->default(false);
        $table->boolean('tax_exempt')->default(false);
        $table->string('classification')->nullable();

        // Contacts
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('email')->nullable();
        $table->string('contact_phone')->nullable();
        $table->boolean('add_to_invoices')->default(true);

        // Billing Address
        $table->string('billing_street')->nullable();
        $table->string('apt_suite')->nullable();
        $table->string('city')->nullable();
        $table->string('state_province')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('country')->nullable();

        // Shipping Address
        $table->string('shipping_street')->nullable();
        $table->string('shipping_apt_suite')->nullable();
        $table->string('shipping_city')->nullable();
        $table->string('shipping_state_province')->nullable();
        $table->string('shipping_postal_code')->nullable();
        $table->string('shipping_country')->nullable();

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
        Schema::dropIfExists('clients');
    }
};
