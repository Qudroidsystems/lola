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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Warehouse name
            $table->string('location')->nullable(); // Location address
            $table->integer('capacity')->default(0); // Maximum capacity of the warehouse
            $table->string('status')->default('Inactive'); // Active or Inactive status
            $table->timestamps();
        });

        Schema::create('warehouse_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->onDelete('cascade'); // Foreign key to warehouses
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products
            $table->integer('quantity')->default(0); // Quantity of product in warehouse
            $table->timestamps();

            $table->unique(['warehouse_id', 'product_id']); // Prevent duplicate entries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_product');
        Schema::dropIfExists('warehouses');
    }
};
