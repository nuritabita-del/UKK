<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete();
            $table->string("order_number")->unique();
            $table->enum("delivery_method", ["pickup", "delivery"])->default("delivery");
            $table->string("recipient_name");
            $table->string("phone");
            $table->text("address")->nullable();
            $table->text("notes")->nullable();
            $table->decimal("subtotal", 12, 2);
            $table->decimal("shipping_cost", 12, 2)->default(0);
            $table->decimal("total", 12, 2);
            $table->enum("status", ["pending", "paid", "processing", "shipped", "completed", "cancelled"])->default("pending");
            $table->string("payment_method")->nullable();
            $table->string("payment_status")->default("pending");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("orders");
    }
};
