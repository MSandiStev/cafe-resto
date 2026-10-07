<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promo;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'products as products_count' => fn ($q) => $q->where('is_available', true),
        ])->orderBy('sort_order')->get();

        // Menu terlaris: dihitung dari jumlah porsi pada pesanan yang tidak dibatalkan.
        $bestSellerIds = OrderItem::query()
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', '!=', 'cancelled')
            ->whereNotNull('order_items.product_id')
            ->groupBy('order_items.product_id')
            ->orderByRaw('SUM(order_items.qty) DESC')
            ->limit(4)
            ->select('order_items.product_id')
            ->pluck('product_id')
            ->all();

        $bestSellers = $bestSellerIds === []
            ? collect()
            : Product::with('category')
                ->whereIn('id', $bestSellerIds)
                ->where('is_available', true)
                ->get()
                ->sortBy(fn (Product $product) => array_search($product->id, $bestSellerIds))
                ->values();

        // Menu pilihan: yang ditandai favorit lebih dulu, lalu yang terbaru. Menu terlaris tidak diulang.
        $featured = Product::with('category')
            ->where('is_available', true)
            ->whereNotIn('id', $bestSellers->pluck('id'))
            ->orderByDesc('is_featured')
            ->latest()
            ->take(8)
            ->get();

        $promos = Promo::with('product')
            ->running()
            ->latest()
            ->take(3)
            ->get();

        $testimonials = Testimonial::where('is_published', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('categories', 'bestSellers', 'featured', 'promos', 'testimonials'));
    }
}
