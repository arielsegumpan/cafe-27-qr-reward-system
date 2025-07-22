<?php

use App\Models\ProductCategory;
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
            $table->string('prod_name')->unique();
            $table->string('prod_slug')->unique()->index();
            $table->text('prod__desc');
            $table->decimal('prod_price', 8, 2);
            $table->string('prod_image')->nullable();
            $table->integer('prod_points')->default(0);
            $table->integer('prod_quantity')->default(1);
            $table->boolean('is_active')->default(1);
            $table->foreignIdFor(ProductCategory::class, 'product_category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
