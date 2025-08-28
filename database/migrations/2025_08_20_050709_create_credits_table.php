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
    Schema::create('credits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('client_id')->constrained()->onDelete('cascade'); // links to clients
        $table->string('status')->default('Pending');
        $table->string('number')->unique();
        $table->decimal('amount', 10, 2);
        $table->date('date');
        $table->date('valid_until');
        $table->timestamps();
        $table->date('credit_date')->default(now())->after('number');
        $table->date('due_date')->nullable()->after('credit_date');
        $table->decimal('partial_deposit', 10,2)->default(0)->after('due_date');
        $table->decimal('discount', 10,2)->default(0)->after('partial_deposit');
        $table->enum('discount_type', ['amount','percent'])->default('amount')->after('discount');
        $table->string('po_number')->nullable()->after('discount_type');
        $table->text('public_notes')->nullable()->after('po_number');
        $table->text('private_notes')->nullable()->after('public_notes');
        $table->text('terms')->nullable()->after('private_notes');
        $table->text('footer')->nullable()->after('terms');
        $table->json('items')->nullable()->after('footer');
        if (!Schema::hasColumn('credits', 'total_amount')) {
            $table->decimal('total_amount', 10, 2)->nullable()->after('amount');
        }

        if (!Schema::hasColumn('credits', 'items')) {
            $table->json('items')->nullable()->after('total_amount');
        }

        // optional: remove old 'client' column if exists
        if (Schema::hasColumn('credits', 'client')) {
            $table->dropColumn('client');
        }
    });
        
    ;
}


    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credits');
    }
};
