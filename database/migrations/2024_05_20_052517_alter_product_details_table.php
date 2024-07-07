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
        Schema::table('product_details', function (Blueprint $table) {

            $table->foreignId('product_id')->after('quantity')->constrained(
                table: 'products',
                indexName: 'product_details_categories_id'
            );

            $table->foreignId('color_id')->after('product_id')->constrained(
                table: 'colors',
                indexName: 'product_details_colors_id'
            );

            $table->foreignId('size_id')->after('color_id')->constrained(
                table: 'sizes',
                indexName: 'product_details_sizes_id'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {

            $table->dropForeign(['product_id', 'color_id', 'size_id']);

            $table->dropColumn(['product_id', 'color_id', 'size_id']);
        });
    }
};
