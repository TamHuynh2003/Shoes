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
       Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique(); // Mã giao dịch
            $table->decimal('amount', 15, 2); // Số tiền
            $table->string('order_info'); // Thông tin đơn hàng
            $table->string('order_type'); // Loại đơn hàng
            $table->string('response_code'); // Mã phản hồi từ VNPay
            $table->string('bank_code')->nullable(); // Mã ngân hàng (nếu có)
            $table->string('vnp_secure_hash'); // Mã bảo mật
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};