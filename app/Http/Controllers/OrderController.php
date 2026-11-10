<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(string $orderNumber)
    {
        $order = Order::with(['items.product', 'user'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        // Generate WhatsApp message link
        $waPhone = '6281234567890';
        $message = "Halo Crumb & Co.! Saya ingin konfirmasi pesanan dengan nomor: *{$order->order_number}* atas nama *{$order->customer_name}* dengan total *{$order->formatted_total}*. Mohon informasinya ya, terima kasih!";
        $waLink = "https://wa.me/{$waPhone}?text=" . urlencode($message);

        return view('pages.order-confirmation', compact('order', 'waLink'));
    }

    public function userOrders()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan masuk untuk melihat riwayat pesanan Anda.');
        }

        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('pages.account-orders', compact('orders'));
    }
}
