<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Product::with('category')
            ->where('is_available', true)
            ->where('is_featured', true)
            ->take(4)
            ->get();

        return view('home', compact('featured'));
    }
}