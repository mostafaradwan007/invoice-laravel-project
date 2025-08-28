<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('quotes', function (Blueprint $table) {
        if (!Schema::hasColumn('quotes', 'total_amount')) {
            $table->decimal('total_amount', 10, 2)->nullable()->after('amount');
        }

        if (!Schema::hasColumn('quotes', 'items')) {
            $table->json('items')->nullable()->after('total_amount');
        }

        // optional: remove old 'client' column if exists
        if (Schema::hasColumn('quotes', 'client')) {
            $table->dropColumn('client');
        }
    });
}


public function down()
{
    Schema::table('quotes', function (Blueprint $table) {
        $table->string('client')->after('id');
        $table->dropColumn(['client_id','total_amount','items']);
    });
}

    
};
