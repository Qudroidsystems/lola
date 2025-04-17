<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('orders')) {
            Schema::create('invoices', function (Blueprint $table) {
                $table->id();
                $table->string('invoice_no')->unique();
                $table->unsignedBigInteger('order_id');
                $table->dateTime('issued_at')->nullable();
                $table->timestamps();

                $table->foreign('order_id')
                      ->references('id')
                      ->on('orders')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};