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
        Schema::create('users', function (Blueprint $table) {

            $table->id();

            $table->string('fullname');
            $table->string('email')->unique();

            $table->string('address')->nullable();
            $table->string('phone_number')->unique()->nullable();

            $table->string('password');
            $table->string('avatar')->nullable();

            $table->date('birth_date')->nullable();
            $table->timestamp('login_at');

            $table->integer('google_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};