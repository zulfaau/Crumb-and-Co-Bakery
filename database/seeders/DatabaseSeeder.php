<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@crumbandco.com'],
            [
                'name' => 'Admin Crumb & Co.',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '+6281234567890',
                'address' => 'Jl. Senopati No. 42, Kebayoran Baru, Jakarta Selatan',
            ]
        );

        $customer = User::firstOrCreate(
            ['email' => 'pelanggan@crumbandco.com'],
            [
                'name' => 'Zulfa Bakery Lover',
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'phone' => '+6289876543210',
                'address' => 'Apartemen Senopati Suites Lt. 12, Jakarta Selatan',
            ]
        );

        // 2. Create Categories
        $categoriesData = [
            [
                'name' => 'Roti Artisan & Sourdough',
                'slug' => 'roti-artisan',
                'description' => 'Dibuat dengan ragi liar alami, fermentasi lambat 36 jam untuk tekstur kenyal dan kerak renyah keemasan.',
                'image_url' => 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Viennoiserie & Croissant',
                'slug' => 'viennoiserie',
                'description' => 'Lapisan mentega Prancis premium (AOP Butter) yang dilipat presisi hingga menghasilkan pastry berlapis renyah dan harum semerbak.',
                'image_url' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Pastry Gurih & Quiche',
                'slug' => 'pastry-gurih',
                'description' => 'Kombinasi keju leleh, jamur truffle, daging asap, dan rempah segar di atas puff pastry renyah gurih.',
                'image_url' => 'https://images.unsplash.com/photo-1621236378699-8597fee6a1ce?auto=format&fit=crop&w=800&q=80',
            ],
            [
                'name' => 'Kue & Sweet Bakes',
                'slug' => 'kue-dan-dessert',
                'description' => 'Dessert elegan dari Basque cheesecake meleleh, tart buah segar musiman, hingga cinnamon morning bun yang memanjakan lidah.',
                'image_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=800&q=80',
            ],
        ];

        $categoryMap = [];
        foreach ($categoriesData as $cat) {
            $created = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
            $categoryMap[$cat['slug']] = $created;
        }

        // 3. Create Products
        $productsData = [
            [
                'category_slug' => 'roti-artisan',
                'name' => 'Country Sourdough Boule',
                'slug' => 'country-sourdough-boule',
                'short_description' => 'Roti sourdough klasik dengan fermentasi 36 jam dan kerak beraroma karamel.',
                'description' => 'Country Sourdough Boule adalah mahakarya baker Crumb & Co. Menggunakan tepung gandum utuh organik dan bibit ragi alami berusia 8 tahun. Dipanggang dalam oven batu panas untuk menghasilkan kerak tebal renyah dan pori-pori kenyal beraroma asam segar yang khas. Sempurna dinikmati bersama mentega asin, keju tua, atau sup krim.',
                'price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1589367920969-ab8e050bbb04?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => false,
                'available' => true,
                'stock' => 25,
                'ingredients' => 'Tepung terigu protein tinggi organik, tepung gandum utuh, air terfiltrasi, ragi liar alami, garam laut Bali.',
                'allergens' => 'Gluten. (Bebas produk susu & telur)',
            ],
            [
                'category_slug' => 'roti-artisan',
                'name' => 'Rosemary & Sea Salt Focaccia',
                'slug' => 'rosemary-sea-salt-focaccia',
                'short_description' => 'Roti khas Italia yang lembut dengan lumuran extra virgin olive oil dan rosemary segar.',
                'description' => 'Focaccia kami dibuat dengan fermentasi dingin, menghasilkan tekstur roti yang sangat empuk, bervolume, dan berkulit keemasan renyah karena genangan extra virgin olive oil Spanyol kualitas terbaik. Dihiasi rosemary segar dari kebun lokal dan kristal garam laut Bali.',
                'price' => 38000,
                'image_url' => 'https://images.unsplash.com/photo-1586444248902-2f64eddc13df?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => true,
                'available' => true,
                'stock' => 20,
                'ingredients' => 'Tepung terigu, minyak zaitun extra virgin, ragi, rosemary segar, bawang putih panggang, garam laut.',
                'allergens' => 'Gluten.',
            ],
            [
                'category_slug' => 'roti-artisan',
                'name' => 'Golden Brioche Loaf',
                'slug' => 'golden-brioche-loaf',
                'short_description' => 'Roti mentega khas Prancis yang lembut bak sutra, cocok untuk toast sarapan.',
                'description' => 'Roti kaya rasa dengan kandungan mentega Prancis dan kuning telur segar berlimpah. Teksturnya super empuk dan meleleh di mulut dengan aroma manis mentega alami. Cocok untuk dibuat French Toast, sandwich gurih, atau dimakan langsung saat hangat.',
                'price' => 52000,
                'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => false,
                'available' => true,
                'stock' => 15,
                'ingredients' => 'Tepung terigu, mentega Elle & Vire AOP, telur segar, susu murni, gula tebu, ragi, garam.',
                'allergens' => 'Gluten, Telur, Susu.',
            ],
            [
                'category_slug' => 'viennoiserie',
                'name' => 'French Butter Croissant',
                'slug' => 'french-butter-croissant',
                'short_description' => 'Croissant autentik dengan 27 lapisan mentega Prancis, renyah di luar dan lumer di dalam.',
                'description' => 'Bintang utama setiap pagi di Crumb & Co. Dibuat dengan 100% mentega AOP Charentes-Poitou dari Prancis. Proses pelipatan 3 hari menghasilkan alveoli sarang lebah sempurna di dalam serta kerenyahan luar biasa saat gigitan pertama. Aromanya langsung membangkitkan semangat pagi Anda.',
                'price' => 28000,
                'image_url' => 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => false,
                'available' => true,
                'stock' => 40,
                'ingredients' => 'Tepung terigu T55 Prancis, mentega AOP Prancis, susu cair, ragi segar, gula, garam laut.',
                'allergens' => 'Gluten, Susu, Produk Turunan Sapi.',
            ],
            [
                'category_slug' => 'viennoiserie',
                'name' => 'Pain au Chocolat',
                'slug' => 'pain-au-chocolat',
                'short_description' => 'Pastry renyah berlapis dengan isian dua batang cokelat hitam Valrhona 64%.',
                'description' => 'Perpaduan sempurna antara adonan croissant berlapis renyah dengan lelehan dua batang cokelat couverture Valrhona Grand Cru 64% asal Prancis. Rasa manis cokelat yang seimbang dengan aroma mentega gurih adalah kemewahan sederhana.',
                'price' => 34000,
                'image_url' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => false,
                'available' => true,
                'stock' => 35,
                'ingredients' => 'Tepung terigu Prancis, mentega AOP, cokelat Valrhona 64%, susu, gula, ragi.',
                'allergens' => 'Gluten, Susu, Kedelai (pada cokelat).',
            ],
            [
                'category_slug' => 'viennoiserie',
                'name' => 'Twice-Baked Almond Croissant',
                'slug' => 'twice-baked-almond-croissant',
                'short_description' => 'Croissant yang dipanggang ulang dengan sirup vanila, krim almond frangipane, dan irisan kacang almond.',
                'description' => 'Croissant mentega yang direndam dalam sirup vanila Madagaskar, diisi melimpah dengan krim frangipane almond buatan tangan, lalu ditaburi irisan almond panggang dan gula halus. Tekstur kontras antara renyahnya taburan almond dan lembutnya isian krim frangipane.',
                'price' => 42000,
                'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => true,
                'available' => true,
                'stock' => 30,
                'ingredients' => 'Croissant mentega, kacang almond California giling, mentega, telur, vanila Madagaskar, gula halus.',
                'allergens' => 'Gluten, Susu, Telur, Kacang Almond (Tree Nuts).',
            ],
            [
                'category_slug' => 'pastry-gurih',
                'name' => 'Truffle Mushroom & Gruyère Danish',
                'slug' => 'truffle-mushroom-gruyere-danish',
                'short_description' => 'Danish pastry gurih dengan tumisan aneka jamur liar, minyak truffle hitam, dan keju Gruyère leleh.',
                'description' => 'Pilihan favorit pencinta savory bakes. Adonan puff pastry renyah diisi keju Gruyère Swiss leleh, saus bechamel lembut, tumisan jamur portobello & champignon dengan bawang putih dan thyme, lalu diselesaikan dengan semprotan minyak black truffle Italia.',
                'price' => 46000,
                'image_url' => 'https://images.unsplash.com/photo-1621236378699-8597fee6a1ce?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => true,
                'available' => true,
                'stock' => 20,
                'ingredients' => 'Puff pastry, jamur portobello, jamur kancing, keju Gruyère, keju Mozzarella, minyak truffle hitam, thyme segar, bawang putih.',
                'allergens' => 'Gluten, Susu.',
            ],
            [
                'category_slug' => 'pastry-gurih',
                'name' => 'Smoked Beef & Cheddar Swirl',
                'slug' => 'smoked-beef-cheddar-swirl',
                'short_description' => 'Gulungan pastry empuk beraroma rosemary dengan potongan daging sapi asap dan red cheddar melimpah.',
                'description' => 'Roti pastry yang digulung menyerupai pusaran, diisi irisan daging sapi asap gurih dan keju cheddar merah Selandia Baru yang meleleh sampai berkaramel di bagian tepiannya. Taburan biji wijen panggang melengkapi kerenyahannya.',
                'price' => 36000,
                'image_url' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => false,
                'available' => true,
                'stock' => 25,
                'ingredients' => 'Tepung terigu, mentega, daging sapi asap, keju red cheddar, saus mustard Dijon, biji wijen.',
                'allergens' => 'Gluten, Susu, Biji Wijen.',
            ],
            [
                'category_slug' => 'kue-dan-dessert',
                'name' => 'San Sebastián Basque Cheesecake',
                'slug' => 'san-sebastian-basque-cheesecake',
                'short_description' => 'Kue keju khas Spanyol dengan permukaan gosong berkaramel dan bagian tengah yang lembut lumer.',
                'description' => 'Cheesecake panggang suhu tinggi khas Basque Country. Permukaannya berwarna cokelat gelap karamel dengan aroma smoky vanilla yang menggoda, sementara bagian tengahnya begitu lembut, creamy, dan meleleh di lidah. Dibuat dengan cream cheese Philadelphia asli dan krim kental impor.',
                'price' => 55000,
                'image_url' => 'https://images.unsplash.com/photo-1533134242443-d4fd215305ad?auto=format&fit=crop&w=800&q=80',
                'featured' => true,
                'newest' => false,
                'available' => true,
                'stock' => 18,
                'ingredients' => 'Cream cheese Philadelphia, krim kental Elle & Vire, telur segar, gula pasir, ekstrak vanila Bourbon, sedikit tepung terigu.',
                'allergens' => 'Susu, Telur, Gluten.',
            ],
            [
                'category_slug' => 'kue-dan-dessert',
                'name' => 'Caramel Cinnamon Morning Bun',
                'slug' => 'caramel-cinnamon-morning-bun',
                'short_description' => 'Roti croissant gulung dengan rempah kayu manis Ceylon, gula kelapa organik, dan saus karamel mentega.',
                'description' => 'Adonan croissant renyah dipilin dengan taburan kayu manis Ceylon organik dan brown sugar aromatik, lalu dipanggang dalam cetakan muffin berlapis mentega dan karamel. Bagian bawahnya renyah berkaramel toffee dan bagian atasnya empuk harum.',
                'price' => 32000,
                'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => true,
                'available' => true,
                'stock' => 28,
                'ingredients' => 'Tepung terigu, mentega Prancis, kayu manis Ceylon, brown sugar, gula tebu organik, garam laut.',
                'allergens' => 'Gluten, Susu.',
            ],
            [
                'category_slug' => 'kue-dan-dessert',
                'name' => 'Pistachio Raspberry Tartlet',
                'slug' => 'pistachio-raspberry-tartlet',
                'short_description' => 'Tartlet renyah dengan krim pistachio Bronte Sicilia dan buah raspberry segar asam manis.',
                'description' => 'Kulit sablé tart yang rapuh renyah bermentega, diisi frangipane pistachio Sisilia murni yang kaya rasa gurih kacang, dilapisi confit raspberry asam segar, dan dihiasi buah raspberry segar impor serta serpihan pistachio panggang.',
                'price' => 48000,
                'image_url' => 'https://images.unsplash.com/photo-1519869325930-281384150729?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => true,
                'available' => true,
                'stock' => 15,
                'ingredients' => 'Tepung terigu, mentega AOP, pasta pistachio Bronte murni, raspberry segar, gula tebu, telur, pektin alami.',
                'allergens' => 'Gluten, Susu, Telur, Kacang Pistachio (Tree Nuts).',
            ],
            [
                'category_slug' => 'roti-artisan',
                'name' => 'Multigrain Seeded Sourdough',
                'slug' => 'multigrain-seeded-sourdough',
                'short_description' => 'Sourdough gandum utuh dengan taburan biji chia, rami, bunga matahari, dan wijen panggang.',
                'description' => 'Roti kaya serat yang padat nutrisi. Campuran tepung gandum utuh (whole wheat) dan rye dengan rendaman 5 jenis biji-bijian bernutrisi tinggi. Memiliki rasa nutty alami yang mendalam dengan aroma asam segar dari fermentasi lambat sourdough.',
                'price' => 49000,
                'image_url' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80',
                'featured' => false,
                'newest' => false,
                'available' => true,
                'stock' => 20,
                'ingredients' => 'Tepung gandum utuh, tepung rye, air terfiltrasi, ragi liar, biji bunga matahari, biji labu, biji rami (flaxseed), biji chia, wijen.',
                'allergens' => 'Gluten, Biji Wijen.',
            ],
        ];

        $createdProducts = [];
        foreach ($productsData as $prod) {
            $catSlug = $prod['category_slug'];
            unset($prod['category_slug']);
            $prod['category_id'] = $categoryMap[$catSlug]->id;
            $created = Product::firstOrCreate(['slug' => $prod['slug']], $prod);
            $createdProducts[] = $created;
        }

        // 4. Create Sample Orders
        if (Order::count() === 0 && count($createdProducts) >= 3) {
            $order1 = Order::create([
                'order_number' => 'CC-' . strtoupper(Str::random(8)),
                'user_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_phone' => $customer->phone,
                'customer_email' => $customer->email,
                'shipping_address' => $customer->address,
                'notes' => 'Tolong dibungkus rapi untuk kado sarapan rekan kerja ya.',
                'delivery_method' => 'delivery',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'subtotal' => 107000,
                'shipping_cost' => 15000,
                'total' => 122000,
                'status' => 'processing',
                'created_at' => now()->subHours(3),
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $createdProducts[0]->id,
                'product_name' => $createdProducts[0]->name,
                'price' => $createdProducts[0]->price,
                'quantity' => 1,
                'subtotal' => $createdProducts[0]->price * 1,
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $createdProducts[3]->id,
                'product_name' => $createdProducts[3]->name,
                'price' => $createdProducts[3]->price,
                'quantity' => 1,
                'subtotal' => $createdProducts[3]->price * 1,
            ]);

            OrderItem::create([
                'order_id' => $order1->id,
                'product_id' => $createdProducts[4]->id,
                'product_name' => $createdProducts[4]->name,
                'price' => $createdProducts[4]->price,
                'quantity' => 1,
                'subtotal' => $createdProducts[4]->price * 1,
            ]);

            $order2 = Order::create([
                'order_number' => 'CC-' . strtoupper(Str::random(8)),
                'user_id' => null,
                'customer_name' => 'Ibu Maya Santoso',
                'customer_phone' => '+6281122334455',
                'customer_email' => 'maya.santoso@gmail.com',
                'shipping_address' => 'Jl. Gunawarman No. 18, Kebayoran Baru, Jakarta Selatan',
                'notes' => 'Diambil sendiri di toko jam 10 pagi.',
                'delivery_method' => 'pickup',
                'payment_method' => 'qris',
                'payment_status' => 'paid',
                'subtotal' => 194000,
                'shipping_cost' => 0,
                'total' => 194000,
                'status' => 'ready',
                'created_at' => now()->subHours(1),
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $createdProducts[6]->id,
                'product_name' => $createdProducts[6]->name,
                'price' => $createdProducts[6]->price,
                'quantity' => 2,
                'subtotal' => $createdProducts[6]->price * 2,
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $createdProducts[8]->id,
                'product_name' => $createdProducts[8]->name,
                'price' => $createdProducts[8]->price,
                'quantity' => 1,
                'subtotal' => $createdProducts[8]->price * 1,
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'product_id' => $createdProducts[5]->id,
                'product_name' => $createdProducts[5]->name,
                'price' => $createdProducts[5]->price,
                'quantity' => 1,
                'subtotal' => $createdProducts[5]->price * 1,
            ]);
        }

        // 5. Create Sample Contact Message
        Contact::firstOrCreate(
            ['email' => 'tanya@bakeryenthusiast.com'],
            [
                'name' => 'Budi Pratama',
                'phone' => '+6285566778899',
                'subject' => 'Pertanyaan Pemesanan Catering Acara Kantor',
                'message' => 'Halo tim Crumb & Co., kami berencana memesan 80 paket mini croissant dan quiche untuk acara peresmian kantor minggu depan. Apakah ada harga paket khusus corporate?',
                'is_read' => false,
            ]
        );
    }
}
