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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Product Name
            $table->text('description')->nullable(); // Product Description
            $table->string('status')->default('Published'); // Status: Published
            $table->string('meta_tag_title')->nullable(); // Meta Tag Title
            // $table->string('meta_tag_name')->nullable(); // Meta Tag Name
            $table->text('meta_tag_description')->nullable(); // Meta Tag Description
            $table->string('meta_tag_keywords')->nullable(); // Meta Tag Keywords
            $table->string('sku')->unique(); // Unique SKU for the variant
            $table->decimal('vat_amount', 5, 2)->nullable(); // VAT Amount (%)
            $table->integer('stock')->default(0); // Stock quantity for this variant
            $table->integer('stock_alert')->default(0); // Stock quantity for this variant
            $table->string('barcode')->nullable(); // Optional Barcode for the variant
            $table->string('thumbnail')->nullable(); // Optional Thumbnail Image for the variant
            $table->decimal('base_price', 10, 2); // Base Price
            $table->decimal('discounted_price', 10, 2)->nullable(); // Discounted Price
            $table->enum('discount_type', ['percentage', 'fixed'])->nullable(); // Discount Type
            $table->decimal('discount_value', 10, 2)->nullable(); // Discount Value (Percentage or Fixed)
            $table->string('tax')->nullable();
            $table->string('tax_value')->nullable();
            $table->string('manufactured')->nullable();
            $table->string('expiry')->nullable();
            $table->timestamps();
        });

        // Create the product_variant table for managing product variants
         Schema::create('product_variant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products
            $table->foreignId('variant_value_id')->constrained()->onDelete('cascade'); // Foreign key to variation values
            $table->string('sku')->unique(); // Unique SKU for the variant
            $table->decimal('vat_amount', 5, 2)->nullable(); // VAT Amount (%)
            $table->integer('stock')->default(0); // Stock quantity for this variant
            $table->integer('stock_alert')->default(0); // Stock quantity for this variant
            $table->string('barcode')->nullable(); // Optional Barcode for the variant
            $table->string('thumbnail')->nullable(); // Optional Thumbnail Image for the variant
            $table->decimal('base_price', 10, 2); // Base Price
            $table->decimal('discounted_price', 10, 2)->nullable(); // Discounted Price
            $table->enum('discount_type', ['percentage', 'fixed'])->nullable(); // Discount Type
            $table->decimal('discount_value', 10, 2)->nullable(); // Discount Value (Percentage or Fixed)
            $table->string('tax')->nullable();
            $table->string('tax_value')->nullable();
            $table->string('manufured')->nullable();
            $table->string('expiry')->nullable();

            $table->timestamps();
        });


        Schema::create('product_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('product_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::create('product_brand', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');   // Foreign key to brands
            $table->timestamps();
            $table->unique(['product_id', 'brand_id']); // Prevent duplicate entries
        });

        Schema::create('product_unit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to products
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');   // Foreign key to units
            $table->decimal('quantity', 10, 2)->nullable(); // Quantity for this unit (e.g., 1 kg, 500 g)
            $table->timestamps();

            $table->unique(['product_id', 'unit_id']); // Prevent duplicate entries
        });



         // Stocks Table
         Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Product reference
            $table->integer('quantity'); // Quantity change (+/-)
            $table->string('type')->comment('Addition or Reduction'); // Type of stock change
            $table->text('reason')->nullable(); // Reason for the change
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // User reference
            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_tag');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('product_brand');
        Schema::dropIfExists('product_unit');
        Schema::dropIfExists('product_variant');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('stocks');
    }
};
