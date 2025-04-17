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
            $table->unsignedBigInteger('order_id'); // Unsigned BigInteger
            $table->unsignedBigInteger('customer_id'); // Unsigned BigInteger
            $table->string('payment_method');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('NGN');
            $table->string('status')->default('Pending');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
