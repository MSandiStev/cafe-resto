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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->uuid('uuid')->unique();                 // dipakai di URL, supaya nomor pesanan tidak bisa ditebak
        $table->string('order_number')->unique();
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        $table->string('customer_name');
        $table->string('customer_phone', 20);
        $table->string('type', 20);                     // dine_in | pickup | delivery
        $table->string('table_number', 10)->nullable();
        $table->text('delivery_address')->nullable();
        $table->text('notes')->nullable();
        $table->unsignedInteger('subtotal');
        $table->unsignedInteger('delivery_fee')->default(0);
        $table->unsignedInteger('total');
        $table->string('status', 20)->default('pending');
        $table->string('payment_status', 20)->default('unpaid');
        $table->string('payment_method', 30)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
