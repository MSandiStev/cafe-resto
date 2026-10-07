<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Stok awal untuk menu yang sudah ada sebelum sistem stok dibuat (bisa dikoreksi dari panel admin). */
    private const BACKFILL_STOCK = 20;

    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedInteger('stock')->default(0)->after('price');
            $table->unsignedInteger('low_stock_threshold')->default(5)->after('stock');
        });

        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type', 20);                       // initial, restock, sale, return, adjustment
            $table->integer('quantity');                      // bertanda: + masuk, - keluar
            $table->unsignedInteger('stock_before');
            $table->unsignedInteger('stock_after');
            $table->string('note', 255)->nullable();
            $table->timestamps();

            $table->index(['product_id', 'created_at']);
        });

        // Menu lama diberi stok awal supaya tidak langsung tampil "Habis", lengkap dengan catatan riwayatnya.
        DB::table('products')->orderBy('id')->each(function ($product) {
            DB::table('products')->where('id', $product->id)->update(['stock' => self::BACKFILL_STOCK]);

            DB::table('stock_movements')->insert([
                'product_id'   => $product->id,
                'type'         => 'initial',
                'quantity'     => self::BACKFILL_STOCK,
                'stock_before' => 0,
                'stock_after'  => self::BACKFILL_STOCK,
                'note'         => 'Stok awal saat sistem stok diaktifkan',
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'low_stock_threshold']);
        });
    }
};
