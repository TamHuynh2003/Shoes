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
        Schema::table('wish_lists', function (Blueprint $table) {

            $table->foreignId('users_id')->after('selling_price')->constrained(
                table: 'users',
                indexName: 'wish_lists_users_id'
            );

            $table->foreignId('product_id')->after('users_id')->constrained(
                table: 'products',
                indexName: 'wish_lists_product_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wish_lists', function (Blueprint $table) {

            $table->dropForeign(['users_id', 'product_id']);

            $table->dropColumn(['users_id', 'product_id']);
        });
    }
};
