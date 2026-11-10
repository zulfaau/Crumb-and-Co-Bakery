<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $bestSellers = Product::with('category')
            ->where('available', true)
            ->where('featured', true)
            ->take(4)
            ->get();

        $newestProducts = Product::with('category')
            ->where('available', true)
            ->where('newest', true)
            ->take(4)
            ->get();

        if ($newestProducts->isEmpty()) {
            $newestProducts = Product::with('category')
                ->where('available', true)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('pages.home', compact('categories', 'bestSellers', 'newestProducts'));
    }
}
