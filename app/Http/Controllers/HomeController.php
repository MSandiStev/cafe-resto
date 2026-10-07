<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $featured = Product::with('category')
            ->where('is_available', true)
            ->orderByDesc('is_featured')
            ->latest()
            ->take(6)
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

        return view('home', compact('categories', 'featured', 'promos', 'testimonials'));
    }
}
