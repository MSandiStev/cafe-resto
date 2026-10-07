<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\StockMovement;
use App\Services\StockService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(int $stock): Product
    {
        $category = Category::create(['name' => 'Kopi', 'slug' => 'kopi', 'sort_order' => 0]);

        $product = Product::create([
            'category_id' => $category->id,
            'name'        => 'Americano',
            'slug'        => 'americano',
            'price'       => 18000,
        ]);

        if ($stock > 0) {
            app(StockService::class)->adjust($product, $stock, 'initial', 'Stok awal');
        }

        return $product->refresh();
    }

    private function checkout(Product $product, int $qty)
    {
        return $this
            ->withSession(['cart' => [$product->id => ['qty' => $qty, 'note' => null]]])
            ->post('/checkout', [
                'customer_name'  => 'Budi',
                'customer_phone' => '081234567890',
                'type'           => 'pickup',
            ]);
    }

    public function test_checkout_reduces_stock_and_records_history(): void
    {
        $product = $this->makeProduct(10);

        $this->checkout($product, 3)->assertRedirect();

        $this->assertSame(7, $product->refresh()->stock);
        $this->assertDatabaseHas('stock_movements', [
            'product_id' => $product->id,
            'type'       => 'sale',
            'quantity'   => -3,
            'stock_after' => 7,
        ]);
    }

    public function test_cannot_add_sold_out_product_to_cart(): void
    {
        $product = $this->makeProduct(0);

        $this->post(route('cart.store', $product), ['qty' => 1])
            ->assertSessionHas('error');

        $this->assertTrue($product->isSoldOut());
    }

    public function test_cannot_add_more_than_available_stock(): void
    {
        $product = $this->makeProduct(2);

        $this->post(route('cart.store', $product), ['qty' => 3])
            ->assertSessionHas('error');
    }

    public function test_checkout_is_rejected_when_stock_ran_out_meanwhile(): void
    {
        $product = $this->makeProduct(5);

        // Stok habis diambil pembeli lain setelah keranjang terisi.
        $this->withSession(['cart' => [$product->id => ['qty' => 5, 'note' => null]]]);
        app(StockService::class)->adjust($product, -4, 'adjustment', 'uji');

        $this->checkout($product, 5)->assertRedirect(route('cart.index'));

        $this->assertSame(0, Order::count());
        $this->assertSame(1, $product->refresh()->stock);
    }

    public function test_cancelling_order_restores_stock_once(): void
    {
        $product = $this->makeProduct(10);
        $this->checkout($product, 4);

        $order = Order::firstOrFail();
        $order->update(['status' => 'cancelled']);

        $this->assertSame(10, $product->refresh()->stock);

        // Disimpan ulang tidak boleh mengembalikan stok dua kali.
        app(\App\Services\StockService::class)->restoreForOrder($order);
        $this->assertSame(10, $product->refresh()->stock);
        $this->assertSame(1, StockMovement::where('type', 'return')->count());
    }

    public function test_low_stock_status(): void
    {
        $product = $this->makeProduct(5); // batas default 5

        $this->assertTrue($product->isLowStock());
        $this->assertSame('low', $product->stockStatus());

        app(StockService::class)->setTo($product, 0, 'habis');
        $this->assertSame('out', $product->refresh()->stockStatus());
    }
}
