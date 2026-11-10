<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalOrders = Order::count();
        $newOrdersCount = Order::where('status', 'new')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with('items')->latest()->take(6)->get();
        $unreadMessagesCount = Contact::where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'newOrdersCount',
            'totalProducts',
            'totalCustomers',
            'recentOrders',
            'unreadMessagesCount'
        ));
    }

    // --- PRODUCTS ---
    public function products(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:3072',
            'featured' => 'boolean',
            'newest' => 'boolean',
            'available' => 'boolean',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
        ]);

        $imageUrl = $validated['image_url'] ?? null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        }

        if (empty($imageUrl)) {
            $imageUrl = 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80';
        }

        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-" . $counter++;
        }

        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => $slug,
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image_url' => $imageUrl,
            'featured' => $request->boolean('featured'),
            'newest' => $request->boolean('newest'),
            'available' => $request->boolean('available', true),
            'ingredients' => $validated['ingredients'] ?? null,
            'allergens' => $validated['allergens'] ?? null,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:200',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|max:3072',
            'featured' => 'boolean',
            'newest' => 'boolean',
            'available' => 'boolean',
            'ingredients' => 'nullable|string',
            'allergens' => 'nullable|string',
        ]);

        $imageUrl = $product->image_url;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imageUrl = $validated['image_url'];
        }

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'short_description' => $validated['short_description'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image_url' => $imageUrl,
            'featured' => $request->boolean('featured'),
            'newest' => $request->boolean('newest'),
            'available' => $request->boolean('available', true),
            'ingredients' => $validated['ingredients'] ?? null,
            'allergens' => $validated['allergens'] ?? null,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function toggleProduct(Product $product)
    {
        $product->available = !$product->available;
        $product->save();

        $status = $product->available ? 'tersedia' : 'tidak tersedia';
        return redirect()->back()->with('success', "Status ketersediaan {$product->name} diubah menjadi {$status}.");
    }

    public function destroyProduct(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()->route('admin.products')->with('success', "Produk '{$name}' telah dihapus.");
    }

    // --- ORDERS ---
    public function orders(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:new,processing,ready,completed,cancelled',
            'payment_status' => 'nullable|in:pending,paid,failed',
        ]);

        $order->status = $request->status;
        if ($request->filled('payment_status')) {
            $order->payment_status = $request->payment_status;
        }
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan ' . $order->order_number . ' berhasil diperbarui.');
    }

    // --- CATEGORIES ---
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'image_url' => 'nullable|url',
        ]);

        $slug = Str::slug($validated['name']);

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'image_url' => $validated['image_url'] ?? 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80',
        ]);

        return redirect()->route('admin.categories')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function destroyCategory(Category $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk.');
        }

        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus.');
    }

    // --- MESSAGES ---
    public function messages()
    {
        $messages = Contact::latest()->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }

    public function markMessageAsRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Pesan ditandai sudah dibaca.');
    }
}
