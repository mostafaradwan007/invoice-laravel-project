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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->onDelete('cascade'); // العميل
        $table->string('invoice_number')->unique(); // رقم الفاتورة
        $table->string('po_number')->nullable(); // PO #
        $table->date('invoice_date'); // تاريخ الفاتورة
        $table->date('due_date')->nullable(); // تاريخ الاستحقاق
        $table->decimal('partial_deposit', 10, 2)->nullable(); // دفعة مقدمة
        $table->decimal('discount', 10, 2)->default(0); // الخصم
        $table->enum('discount_type', ['amount', 'percent'])->default('amount'); // نوع الخصم
        $table->text('public_notes')->nullable();
        $table->text('private_notes')->nullable();
        $table->text('terms')->nullable();
        $table->text('footer')->nullable();
        $table->decimal('subtotal', 10, 2)->default(0); // المجموع قبل الخصم
        $table->decimal('total', 10, 2)->default(0); // الإجمالي
        $table->decimal('paid_to_date', 10, 2)->default(0);
        $table->decimal('balance_due', 10, 2)->default(0);
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
        Schema::dropIfExists('invoices');
    }
};
