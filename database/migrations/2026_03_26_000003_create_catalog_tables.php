<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('price_visibility', 16)->default('default'); // default|visible|hidden
            $table->boolean('quote_enabled')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('price_visibility', 16)->default('default'); // default|visible|hidden
            $table->boolean('quote_enabled')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('brand_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->index();
            $table->text('short_spec')->nullable();
            $table->string('price_text')->nullable();
            $table->string('image_url')->nullable();
            $table->string('source_url')->nullable();
            $table->string('price_visibility', 16)->default('default'); // default|visible|hidden
            $table->boolean('quote_enabled')->default(true);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category_id', 'is_active']);
            $table->index(['brand_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('categories');
    }
};
