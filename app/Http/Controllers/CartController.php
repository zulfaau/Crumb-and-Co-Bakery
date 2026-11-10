<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getCart(): array
    {
        return session()->get('cart', []);
    }

    private function saveCart(array $cart): void
    {
        session()->put('cart', $cart);
    }

    private function calculateTotals(array $cart): array
    {
        $subtotal = 0;
        $count = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $count += $item['quantity'];
        }

        $freeShippingThreshold = 150000;
        $shippingCost = ($subtotal >= $freeShippingThreshold || $subtotal === 0) ? 0 : 15000;
        $total = $subtotal + $shippingCost;
        $progressToFreeShipping = min(100, ($subtotal / $freeShippingThreshold) * 100);
        $amountLeftForFreeShipping = max(0, $freeShippingThreshold - $subtotal);

        return [
            'subtotal' => $subtotal,
            'shipping' => $shippingCost,
            'total' => $total,
            'item_count' => $count,
            'free_shipping_threshold' => $freeShippingThreshold,
            'progress' => $progressToFreeShipping,
            'amount_left_free_shipping' => $amountLeftForFreeShipping,
        ];
    }

    public function index()
    {
        $cart = $this->getCart();
        $totals = $this->calculateTotals($cart);

        return view('pages.cart', compact('cart', 'totals'));
    }

    public function get()
    {
        $cart = $this->getCart();
        $totals = $this->calculateTotals($cart);

        return response()->json([
            'items' => array_values($cart),
            'totals' => $totals,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->available) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, produk ini sedang tidak tersedia.',
            ], 422);
        }

        $qtyToAdd = max(1, (int) $request->input('quantity', 1));
        $cart = $this->getCart();
        $id = $product->id;

        // Check stock limit
        $currentQty = isset($cart[$id]) ? $cart[$id]['quantity'] : 0;
        $newQty = $currentQty + $qtyToAdd;

        if ($product->stock > 0 && $newQty > $product->stock) {
            $message = $currentQty > 0
                ? "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}, sudah ada {$currentQty} di keranjang."
                : "Jumlah melebihi stok. Stok {$product->name} tersedia: {$product->stock}.";

            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }
            return redirect()->back()->with('error', $message);
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $newQty;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'category_name' => $product->category?->name ?? 'Artisan Bakery',
                'quantity' => $qtyToAdd,
                'stock' => $product->stock,
            ];
        }

        $this->saveCart($cart);
        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "{$product->name} berhasil ditambahkan ke keranjang!",
                'cart' => array_values($cart),
                'totals' => $totals,
            ]);
        }

        return redirect()->back()->with('success', "{$product->name} berhasil ditambahkan ke keranjang!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = $this->getCart();
        $id = $request->product_id;

        if ($request->quantity <= 0) {
            unset($cart[$id]);
        } elseif (isset($cart[$id])) {
            // Respect stock limit
            $product = Product::find($id);
            $maxQty = ($product && $product->stock > 0) ? $product->stock : 999;
            $cart[$id]['quantity'] = min($request->quantity, $maxQty);
        }

        $this->saveCart($cart);
        $totals = $this->calculateTotals($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui.',
                'cart' => array_values($cart),
                'totals' => $totals,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = $this->getCart();
        $id = $request->product_id;

        if (isset($cart[$id])) {
            $name = $cart[$id]['name'];
            unset($cart[$id]);
            $this->saveCart($cart);

            $totals = $this->calculateTotals($cart);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "{$name} dihapus dari keranjang.",
                    'cart' => array_values($cart),
                    'totals' => $totals,
                ]);
            }

            return redirect()->route('cart.index')->with('success', "{$name} dihapus dari keranjang.");
        }

        return redirect()->route('cart.index');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Keranjang telah dikosongkan.');
    }
}
