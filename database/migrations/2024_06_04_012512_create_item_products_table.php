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
        Schema::create('item_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('item_brands')->onDelete('cascade');
            $table->string('product_name')->unique();
            $table->foreignId('size_id')->constrained('item_sizes')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->foreignId('quantity_id')->constrained('item_quantities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_products');
    }
};
