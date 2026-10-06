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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
        $table->string('product_name');                 // salinan nama dan harga saat pesan,
        $table->unsignedInteger('price');               // supaya riwayat tidak berubah kalau menu diedit
        $table->unsignedSmallInteger('qty');
        $table->string('note', 200)->nullable();
        $table->unsignedInteger('subtotal');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
