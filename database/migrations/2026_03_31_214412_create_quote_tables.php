<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('quote_no')->unique();
            $table->foreignId('customer_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('new');
            $table->string('requester_name');
            $table->string('requester_email');
            $table->string('requester_phone')->nullable();
            $table->string('company_name')->nullable();
            $table->string('tax_number')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });

        Schema::create('quote_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('product_name');
            $table->string('product_code')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('quote_response_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_item_id')->unique()->constrained()->cascadeOnDelete();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->string('currency', 3)->default('TRY');
            $table->string('lead_time')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
        });

        Schema::create('quote_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_request_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_status_histories');
        Schema::dropIfExists('quote_response_items');
        Schema::dropIfExists('quote_items');
        Schema::dropIfExists('quote_requests');
    }
};
