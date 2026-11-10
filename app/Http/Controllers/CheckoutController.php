<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('info', 'Keranjang belanja Anda masih kosong. Silakan pilih roti favorit Anda terlebih dahulu.');
        }

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shipping = $subtotal >= 150000 ? 0 : 15000;
        $total = $subtotal + $shipping;

        $user = auth()->user();

        return view('pages.checkout', compact('cart', 'subtotal', 'shipping', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang belanja kosong.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|min:2|max:120',
            'customer_phone' => 'required|string|regex:/^[+()\d\s.-]{8,24}$/',
            'customer_email' => 'nullable|email|max:120',
            'shipping_address' => 'required|string|min:8|max:1000',
            'notes' => 'nullable|string|max:1000',
            'delivery_method' => 'required|in:delivery,pickup',
            'payment_method' => 'required|in:cod,bank_transfer,qris',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_phone.required' => 'Nomor WhatsApp / telepon wajib diisi.',
            'customer_phone.regex' => 'Format nomor telepon tidak valid.',
            'shipping_address.required' => 'Alamat pengiriman wajib diisi.',
            'payment_method.required' => 'Silakan pilih metode pembayaran.',
        ]);

        return DB::transaction(function () use ($validated, $cart) {
            // Verify product prices and stock from DB directly
            $subtotal = 0;
            $orderItemsData = [];

            foreach ($cart as $item) {
                $product = Product::lockForUpdate()->findOrFail($item['id']);

                if (!$product->available) {
                    throw new \Exception("Maaf, produk '{$product->name}' sedang tidak tersedia.");
                }

                $quantity = max(1, (int) $item['quantity']);

                // Validate quantity against actual stock
                if ($product->stock > 0 && $quantity > $product->stock) {
                    throw new \Exception(
                        "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}, ".
                        "jumlah dipesan: {$quantity}. Silakan perbarui keranjang Anda."
                    );
                }
                $itemSubtotal = $product->price * $quantity;
                $subtotal += $itemSubtotal;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ];
            }

            // Calculate shipping cost
            $shippingCost = 0;
            if ($validated['delivery_method'] === 'delivery') {
                $shippingCost = $subtotal >= 150000 ? 0 : 15000;
            }

            $total = $subtotal + $shippingCost;

            // Generate unique human-readable order number: CC-261109-ABCD
            $orderNumber = 'CC-' . date('ymd') . '-' . strtoupper(Str::random(4));

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'customer_phone' => $validated['customer_phone'],
                'customer_email' => $validated['customer_email'] ?? (auth()->user()?->email),
                'shipping_address' => $validated['shipping_address'],
                'notes' => $validated['notes'] ?? null,
                'delivery_method' => $validated['delivery_method'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'pending',
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'new',
            ]);

            foreach ($orderItemsData as $itemData) {
                $itemData['order_id'] = $order->id;
                OrderItem::create($itemData);
            }

            // Clear cart
            session()->forget('cart');

            return redirect()->route('orders.show', $order->order_number)->with('success', 'Pesanan Anda berhasil dibuat!');
        });
    }
}
