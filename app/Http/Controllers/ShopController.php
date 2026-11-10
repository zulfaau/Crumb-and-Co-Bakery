<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('category')->where('available', true);

        // Filter by category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Search by keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('featured', 'desc')->latest();
                break;
            case 'newest':
            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.product-grid', compact('products'))->render(),
                'pagination' => (string) $products->links(),
                'total' => $products->total(),
            ]);
        }

        return view('pages.shop', compact('products', 'categories'));
    }

    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('available', true)
            ->take(4)
            ->get();

        return view('pages.product-detail', compact('product', 'relatedProducts'));
    }
}
