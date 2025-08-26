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
       Schema::table('quotes', function (Blueprint $table) {
    $table->date('quote_date')->default(now())->after('number');
    $table->date('due_date')->nullable()->after('quote_date');
    $table->decimal('partial_deposit', 10,2)->default(0)->after('due_date');
    $table->decimal('discount', 10,2)->default(0)->after('partial_deposit');
    $table->enum('discount_type', ['amount','percent'])->default('amount')->after('discount');
    $table->string('po_number')->nullable()->after('discount_type');
    $table->text('public_notes')->nullable()->after('po_number');
    $table->text('private_notes')->nullable()->after('public_notes');
    $table->text('terms')->nullable()->after('private_notes');
    $table->text('footer')->nullable()->after('terms');
    $table->json('items')->nullable()->after('footer');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            //
        });
    }
};
