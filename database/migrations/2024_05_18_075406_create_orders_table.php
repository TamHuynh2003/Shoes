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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->date('order_date');

            $table->string('address');
            $table->string('email');
            $table->string('phone_number');

            $table->decimal('shipping_cost');

            $table->boolean('payment_status')->default(false);

            // $table->boolean('is_deleted')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
