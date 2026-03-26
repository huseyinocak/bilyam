<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_user_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('full_name');
            $table->string('company_name');
            $table->string('phone', 32);
            $table->string('email');
            $table->string('city')->nullable();
            $table->text('note')->nullable();
            $table->string('status', 32)->default('received');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });

        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedInteger('quantity')->default(1);
            $table->string('unit')->default('adet');
            $table->timestamps();

            $table->unique(['quote_request_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_items');
        Schema::dropIfExists('quote_requests');
    }
};
