<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('sort_order')->get();

        $products = Product::with('category')
            ->where('is_available', true)
            ->when($request->category, fn ($q, $slug) =>
                $q->whereHas('category', fn ($c) => $c->where('slug', $slug))
            )
            ->orderBy('name')
            ->get();

        return view('menu.index', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        $product->load('category');
        return view('menu.show', compact('product'));
    }
}