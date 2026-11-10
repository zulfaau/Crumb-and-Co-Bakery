<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class BakeryStoreTest extends TestCase
{
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Crumb');
        $response->assertSee('Freshly Baked');
    }

    public function test_shop_page_loads_and_displays_products(): void
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertSee('Katalog Bakeshop');
        $response->assertSee('Country Sourdough Boule');
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::first();
        $response = $this->get('/shop/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->formatted_price);
    }

    public function test_cart_operations(): void
    {
        $product = Product::first();

        // Add to cart
        $response = $this->postJson('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // View cart page
        $cartPage = $this->get('/cart');
        $cartPage->assertStatus(200);
        $cartPage->assertSee($product->name);

        // Update cart
        $updateRes = $this->postJson('/cart/update', [
            'product_id' => $product->id,
            'quantity' => 3,
        ]);
        $updateRes->assertStatus(200);
        $this->assertEquals(3, session('cart')[$product->id]['quantity']);
    }

    public function test_checkout_creates_order(): void
    {
        $product = Product::first();
        session(['cart' => [
            $product->id => [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'image_url' => $product->image_url,
                'category_name' => 'Artisan Bakes',
                'quantity' => 2,
            ]
        ]]);

        $response = $this->post('/checkout', [
            'customer_name' => 'Budi Tester',
            'customer_phone' => '081234567890',
            'customer_email' => 'budi@test.com',
            'delivery_method' => 'delivery',
            'shipping_address' => 'Jl. Kemang Raya No. 10, Jakarta Selatan',
            'payment_method' => 'bank_transfer',
            'notes' => 'Tolong diantar hangat.',
        ]);

        $order = Order::latest()->first();
        $this->assertNotNull($order);
        $this->assertEquals('Budi Tester', $order->customer_name);
        $response->assertRedirect('/orders/' . $order->order_number);

        // Check order confirmation page
        $confirmPage = $this->get('/orders/' . $order->order_number);
        $confirmPage->assertStatus(200);
        $confirmPage->assertSee($order->order_number);
    }

    public function test_about_and_contact_pages(): void
    {
        $about = $this->get('/about');
        $about->assertStatus(200);
        $about->assertSee('Tradisi Roti Sejati');

        $contact = $this->get('/contact');
        $contact->assertStatus(200);
        $contact->assertSee('Hubungi Kami');

        $submitContact = $this->post('/contact', [
            'name' => 'Klien Event',
            'email' => 'event@klien.com',
            'phone' => '081299998888',
            'subject' => 'Pemesanan Roti Event',
            'message' => 'Halo, kami ingin memesan 50 croissant untuk acara sarapan kantor besok.',
        ]);
        $submitContact->assertRedirect();
        $submitContact->assertSessionHas('success');
    }

    public function test_admin_access_control(): void
    {
        // Guest cannot access admin
        $guestRes = $this->get('/admin');
        $guestRes->assertRedirect('/login');

        // Normal customer cannot access admin
        $customer = User::where('role', 'customer')->first();
        $customerRes = $this->actingAs($customer)->get('/admin');
        $customerRes->assertRedirect('/login');

        // Admin can access
        $admin = User::where('role', 'admin')->first();
        $adminRes = $this->actingAs($admin)->get('/admin');
        $adminRes->assertStatus(200);
        $adminRes->assertSee('Ringkasan Toko');
    }
}
