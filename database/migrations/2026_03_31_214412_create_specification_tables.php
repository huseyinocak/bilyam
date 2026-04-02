<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specification_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('specification_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('specification_template_id')->constrained('specification_templates')->cascadeOnDelete();
            $table->string('name');
            $table->string('key');
            $table->string('field_type')->default('text');
            $table->string('unit')->nullable();
            $table->boolean('is_filterable')->default(false);
            $table->boolean('is_required')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->unique(['specification_template_id', 'key'], 'spec_fields_template_key_unique');
        });

        Schema::create('product_specification_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specification_field_id')->constrained('specification_fields')->cascadeOnDelete();
            $table->text('value')->nullable();
            $table->timestamps();
            $table->unique(['product_id', 'specification_field_id'], 'product_spec_values_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_specification_values');
        Schema::dropIfExists('specification_fields');
        Schema::dropIfExists('specification_templates');
    }
};
