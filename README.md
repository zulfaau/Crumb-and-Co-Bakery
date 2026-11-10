# Crumb & Co. — Artisan Bakery & Patisserie 🥐

Aplikasi web toko roti artisan modern berbasis **Laravel 11 (PHP 8.4)** dengan database **MySQL (Port 3310)** serta frontend interaktif menggunakan **Blade, Tailwind CSS, dan Alpine.js**.

---



- **Backend:** Laravel 11 / 12 (PHP 8.4)
- **Database:** MySQL pada port `3310` (Database: `crumb_and_co`, User: `root`, Password: kosong)
- **Frontend:**
  - Modern Blade Templates
  - Tailwind CSS (Warm artisan palette: Espresso `#49352A`, Cinnamon `#B97859`, Flour Cream `#FAF7F0`)
  - Alpine.js (Reactive Shopping Cart Drawer, Toast Notifications, Live Search & Filters)
- **Testing:** PHPUnit Feature Tests (100% Passed)

---

## 🚀 Fitur Utama

### 🛒 Toko & Pengalaman Pelanggan (Front-End)
1. **Beranda Eksklusif (`/`):**
   - Hero banner dengan visual artisan bakery
   - Jaminan mutu (36 jam fermentasi dingin, 100% Mentega Prancis AOP, tanpa bahan pengawet)
   - Menu Terlaris (*Best Sellers*) & Menu Baru Mingguan
   - Showcase 4 Kategori Utama (*Sourdough, Viennoiserie, Savory Pastry, Sweet Bakes*)
   - Kisah toko & ulasan pelanggan
2. **Katalog & Menu Toko (`/shop`):**
   - Filter cepat berdasarkan kategori
   - Pencarian real-time nama dan deskripsi roti
   - Pengurutan: Menu Terbaru, Paling Populer, Harga Terendah / Tertinggi
   - Kartu produk dengan badge status (*Terlaris, Baru, Habis*) dan tombol instant *+ Keranjang*
3. **Detail Produk (`/shop/{slug}`):**
   - Foto resolusi tinggi & status panggangan harian
   - Penghitung jumlah pesanan (*quantity selector*)
   - Tab informasi: Deskripsi Lengkap, Komposisi Bahan Baku, Informasi Alergen, dan Saran Penyajian / Pemanasan
   - Rekomendasi produk terkait
4. **Keranjang Belanja Interaktif (`/cart`):**
   - *Slide-over Cart Drawer* yang dapat dibuka dari halaman manapun
   - Indikator progres **GRATIS Ongkir** se-Jakarta (otomatis gratis jika total belanja $\ge$ Rp 150.000)
   - Pengaturan jumlah item (+ / -) dan penghapusan produk
5. **Checkout & Pembayaran (`/checkout`):**
   - Formulir data penerima & nomor WhatsApp
   - Pilihan metode pengiriman (*Kirim ke Alamat* atau *Ambil Sendiri di Toko Senopati*)
   - Pilihan metode pembayaran:
     - **Transfer Bank / Virtual Account (BCA, Mandiri, BRI)**
     - **QRIS All Payment**
     - **Cash on Delivery (COD)**
6. **Struk & Konfirmasi Pesanan (`/orders/{orderNumber}`):**
   - Nomor pesanan unik (contoh: `CC-261109-ABCD`)
   - Timeline pelacakan status (*Diterima &rarr; Dipanggang &rarr; Siap Diambil/Dikirim &rarr; Selesai*)
   - Petunjuk pembayaran nomor rekening resmi
   - Tombol langsung: **Konfirmasi Pesanan via WhatsApp** (terisi pesan otomatis dengan nomor pesanan & nama pemesan)
   - Tombol Cetak Struk / Invoice
7. **Autentikasi & Akun Pelanggan:**
   - Masuk Akun (`/login`) & Daftar Akun (`/register`)
   - Riwayat Pesanan Saya (`/account/orders`)
8. **Tentang Kami (`/about`) & Kontak Lokasi (`/contact`):**
   - Cerita 4 pilar kualitas pemanggangan Crumb & Co.
   - Jam operasional, alamat toko di Senopati, nomor WhatsApp, serta formulir pengiriman pesan.

---

### 🛡️ Admin Workspace (`/admin`)
Dilindungi oleh middleware khusus admin (`admin` middleware):
- **Dashboard Ringkasan:** Omset penjualan aktif, total pesanan masuk, jumlah produk, jumlah pelanggan terdaftar, dan tabel pesanan terkini.
- **Kelola Produk (`/admin/products`):**
  - Tambah produk baru dengan upload gambar / link gambar
  - Edit produk, harga, stok, komposisi, dan alergen
  - Toggle satu-klik status ketersediaan (*Tersedia / Habis*)
  - Hapus produk
- **Pesanan Toko (`/admin/orders`):**
  - Filter pesanan berdasarkan status: *Semua, Baru, Dipanggang/Diproses, Siap, Selesai, Dibatalkan*
  - Detail pesanan & alamat pengiriman lengkap
  - Update status pengerjaan dan status pembayaran dengan satu klik
  - Tombol langsung hubungi nomor WhatsApp pembeli
- **Kategori Produk (`/admin/categories`):** Tambah dan hapus kategori toko
- **Pesan Kontak (`/admin/messages`):** Pantau pertanyaan masuk dari formulir kontak pelanggan

---

## 🔑 Akun Demo Bawaan

| Role | Email | Password | Akses |
|---|---|---|---|
| **Administrator** | `admin@crumbandco.com` | `password123` | Akses penuh ke Dashboard Admin `/admin` & Toko |
| **Pelanggan** | `pelanggan@crumbandco.com` | `password123` | Belanja, Checkout, dan Riwayat Pesanan |

---

## ⚙️ Menjalankan Aplikasi

1. **Pastikan MySQL berjalan di port `3310`:**
   Database yang digunakan: `crumb_and_co`.

2. **Jalankan Development Server:**
   ```bash
   php artisan serve
   ```
   Aplikasi akan dapat diakses di browser pada:
   👉 **`http://localhost:8000`**

3. **Menjalankan Pengujian Otomatis (Testing):**
   ```bash
   php artisan test
   ```
