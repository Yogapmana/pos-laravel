# Product Requirements Document (PRD)
# Sistem Informasi Restoran Dapur Bunda Bahagia

---

## 1. Pendahuluan

### 1.1 Latar Belakang

Restoran Dapur Bunda Bahagia merupakan usaha kuliner yang saat ini mengelola seluruh kegiatan operasionalnya secara manual. Untuk mengatasi risiko kesalahan pencatatan pesanan, lambatnya proses transaksi, dan sulitnya pemantauan stok secara real-time, diperlukan sebuah Sistem Informasi Restoran terkomputerisasi yang terpusat dan efisien.

### 1.2 Tujuan Dokumen

- Mendefinisikan kebutuhan fungsional dan non-fungsional dari sistem secara lengkap dan terukur.
- Menjadi panduan bagi tim pengembang dalam merancang, membangun, dan menguji sistem menggunakan arsitektur Full Stack Laravel.
- Memastikan sistem memenuhi kriteria kompetensi pemrograman (J.620100.009.02 hingga J.620100.033.02).

### 1.3 Ruang Lingkup Sistem

Mencakup empat domain utama:

- **Manajemen Pemesanan**: Pencatatan pesanan per meja.
- **Transaksi Penjualan**: Proses billing, pembayaran, dan cetak struk.
- **Manajemen Stok**: Pengelolaan ketersediaan produk oleh admin.
- **Laporan Penjualan**: Pelaporan berkala (mingguan/bulanan).

---

## 2. Deskripsi Umum Sistem

### 2.1 Perspektif Produk

Sistem ini dibangun dengan arsitektur Monolithic, di mana Frontend dan Backend berada dalam satu codebase (satu wadah) menggunakan framework Laravel. Halaman dirender di sisi server (Server-Side Rendering) menggunakan template engine Blade, sementara interaktivitas real-time di halaman kasir ditangani oleh komponen Livewire.

### 2.2 Karakteristik Pengguna

| Peran         | Akses          | Tanggung Jawab                                              |
|---------------|----------------|-------------------------------------------------------------|
| Administrator | Akses Penuh    | Mengelola produk, stok, akun user, dan memantau laporan.  |
| Kasir         | Modul Kasir    | Mencatat pesanan pelanggan, memproses pembayaran, menerbitkan struk. |

---

## 3. Arsitektur dan Tech Stack

### 3.1 Tabel Tech Stack (TALL Stack)

| Layer / Kebutuhan           | Teknologi                     | Keterangan                                                              |
|-----------------------------|-------------------------------|-------------------------------------------------------------------------|
| Backend Framework           | Laravel 11.x (PHP 8.x)       | Framework utama pemrosesan logika bisnis & routing.                     |
| Frontend Rendering          | Laravel Blade                | Template engine bawaan Laravel untuk struktur HTML.                     |
| Frontend Reactivity         | Laravel Livewire             | Membuat komponen dinamis tanpa menulis JavaScript terpisah.              |
| Frontend Interactivity      | Alpine.js                    | JS ringan untuk manipulasi UI sederhana (buka/tutup modal, dropdown).   |
| Styling                     | Tailwind CSS                 | Styling utilitas untuk mempercepat desain UI.                           |
| Database                    | MySQL / PostgreSQL            | Relational Database Management System.                                  |
| ORM & Database Access       | Eloquent ORM                 | Akses basis data berorientasi objek bawaan Laravel.                    |
| Testing                     | PHPUnit                      | Pengujian unit dan feature.                                             |
| Dokumentasi                | PHPDoc / Scribe              | Dokumentasi source code dan fungsionalitas.                             |
| Library Struk & Laporan     | DomPDF & Laravel Excel        | Ekspor struk PDF dan laporan ke Excel.                                  |

### 3.2 Pemetaan Tech Stack terhadap Kriteria Kompetensi SKKNI

| Kode Kompetensi   | Kriteria                                   | Dipenuhi Oleh                                                            |
|-------------------|--------------------------------------------|-------------------------------------------------------------------------|
| J.620100.009.02   | Menggunakan Spesifikasi Program            | Dokumen PRD ini                                                         |
| J.620100.016.01   | Guidelines dan Best Practices              | Standar PSR-12, Laravel Pint                                            |
| J.620100.017.02   | Pemrograman Terstruktur                    | Arsitektur MVC Laravel (Routing, Middleware, Controllers, Livewire Components) |
| J.620100.018.02   | Pemrograman Berorientasi Objek             | Penggunaan Class, Interface, Traits, dan Dependency Injection di Laravel |
| J.620100.019.02   | Library Pre-Existing                       | Composer packages (Livewire, DomPDF, Laravel Excel)                     |
| J.620100.021.02   | Menerapkan Akses Basis Data               | Eloquent ORM, Migrations, Seeders                                       |
| J.620100.023.02   | Membuat Dokumen Kode Program               | PHPDoc pada setiap Class dan Method                                     |
| J.620100.025.02   | Melakukan Debugging                        | Laravel Telescope, penanganan Exception (Try-Catch)                      |
| J.620100.033.02   | Melaksanakan Pengujian Unit                | PHPUnit (php artisan test)                                              |

---

## 4. Kebutuhan Fungsional

### 4.1 Modul Pemesanan (M1) - Ditenagai oleh Livewire

| No | Fitur                                      | Prioritas    |
|----|--------------------------------------------|--------------|
| 1  | Pilih meja & input pesanan tanpa refresh halaman | Must have  |
| 2  | Filter menu per kategori (Makanan, Appetizer, Minuman) | Must have |
| 3  | Ubah / hapus item di keranjang (cart)      | Must have    |
| 4  | Tambah catatan khusus per item ("tidak pedas") | Should have |

### 4.2 Modul Transaksi & Pembayaran (M2)

| No | Fitur                                      | Prioritas    |
|----|--------------------------------------------|--------------|
| 1  | Hitung billing otomatis (Subtotal, PPN, Total) | Must have |
| 2  | Pembayaran tunai & hitung kembalian otomatis | Must have  |
| 3  | Pembayaran non-tunai (Midtrans API)        | Must have    |
| 4  | Cetak struk digital (DomPDF)              | Must have    |

### 4.3 Modul Manajemen Stok & Admin (M3 & M4)

| No | Fitur                                      | Prioritas    |
|----|--------------------------------------------|--------------|
| 1  | CRUD Master Data (Produk, Kategori, Meja, User) | Must have |
| 2  | Pengurangan stok otomatis setelah transaksi berhasil | Must have |
| 3  | Laporan Penjualan (Mingguan/Bulanan)       | Must have    |
| 4  | Ekspor Laporan ke Excel & PDF              | Must have    |

---

## 5. Kebutuhan Non-Fungsional

### Keamanan

Memfaatkan proteksi CSRF (Cross-Site Request Forgery) bawaan Laravel untuk seluruh form. Password dienkripsi menggunakan Bcrypt.

### Validasi

Validasi ketat di sisi server menggunakan Laravel Form Requests atau aturan validasi Livewire.

### Performa

Penggunaan Eager Loading (`with()`) pada Eloquent ORM untuk mencegah masalah N+1 query yang sering membuat aplikasi melambat.

---

## 6. Skema Basis Data (Laravel Migrations)

| Tabel (snake_case) | Deskripsi                                                           |
|---------------------|---------------------------------------------------------------------|
| users               | Data otentikasi (Kasir & Admin).                                   |
| categories          | Kategori produk.                                                    |
| products            | Data menu restoran, harga, dan stok saat ini.                       |
| tables              | Data meja restoran (Nomor meja, kapasitas).                         |
| orders              | Header transaksi (ID Meja, ID Kasir, Status: Pending/Paid).        |
| order_items         | Detail item yang dipesan beserta harga saat itu (snapshot price).   |
| transactions        | Log pembayaran (Metode bayar, nominal masuk, kembalian).            |

---

## 7. Arsitektur Struktur Folder (Laravel)

```
app/
├── Http/
│   ├── Controllers/       # Controller klasik untuk halaman non-interaktif (Laporan)
├── Livewire/              # Komponen dinamis pengganti Vue/React
│   └── Pos/
│       ├── Cart.php       # Logic keranjang kasir (PHP)
│       └── ProductList.php # Logic daftar menu (PHP)
├── Models/                # Eloquent Models
│   ├── Product.php
│   ├── Order.php
└── Services/              # Logika bisnis yang kompleks dipisah ke sini
    └── TransactionService.php

resources/
├── views/
│   ├── livewire/          # Tampilan Blade untuk komponen Livewire
│   │   └── pos/
│   │       ├── cart.blade.php
│   │       └── product-list.blade.php
│   ├── layouts/           # Template utama HTML (Header, Sidebar)
│   └── pages/             # Tampilan halaman statis

tests/
├── Feature/               # Pengujian alur (Misal: simulasi kasir checkout)
└── Unit/                  # Pengujian fungsi (Misal: kalkulasi PPN)
```

---

## 8. Rencana Pengujian (PHPUnit)

Setiap fitur krusial akan diuji menggunakan perintah `php artisan test`.

### Pengujian Unit (Unit Test)

Menguji apakah fungsi `calculateTax()` pada TransactionService menghasilkan nilai PPN 11% yang akurat.

### Pengujian Komponen (Livewire Test)

Menggunakan fitur bawaan `Livewire::test()` untuk memastikan bahwa ketika kasir mengklik tombol "Tambah", item benar-benar masuk ke dalam properti cart tanpa harus membuka browser.

---

## 9. Standar Penulisan Kode

- Mengikuti **PSR-12** (PHP Standard Recommendation).
- **Fat Models / Services, Skinny Controllers**: Usahakan Controller dan Livewire Component hanya berisi sedikit baris kode. Logika perhitungan (seperti kalkulasi stok dan total harga) harus diletakkan di dalam Service Class atau fungsi dalam Model agar mudah diuji secara OOP.
