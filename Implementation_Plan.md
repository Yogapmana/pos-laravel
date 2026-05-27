# Implementation Plan
# Sistem Informasi Restoran Dapur Bunda Bahagia

> **Last Updated**: 2026-05-16

---

## Overview

Rencana implementasi ini berdasarkan analysis gap antara PRD.md dan kondisi code saat ini. Target utama: menyelesaikan seluruh fitur yang belum terimplementasi sesuai spesifikasi, dengan menggunakan design system **Verdana Health** sebagai referensi visual.

---

## Design System: Verdana Health

### Warna (Color Palette)
| Nama | Hex | Penggunaan |
|------|-----|------------|
| Primary Navy | `#0F172A` | Primary actions, headers, buttons |
| Secondary Slate | `#64748B` | Secondary text, borders |
| Tertiary Sage | `#059669` | Links, CTAs, highlights (untuk status sukses) |
| Background | `#F8FAFC` | Page background |
| Surface | `#FFFFFF` | Card backgrounds |
| Success | `#22C55E` | Confirmed, paid, success states |
| Warning | `#EAB308` | Pending, caution states |
| Error | `#EF4444` | Critical, error states |
| Info | `#0EA5E9` | Informational |

### Typography
- **Headlines**: Plus Jakarta Sans
- **Body**: DM Sans
- **Mono/Code**: Fira Code

### Spacing (Base: 8px)
- `xs`: 4px, `sm`: 8px, `md`: 16px, `lg`: 24px, `xl`: 32px, `2xl`: 48px, `3xl`: 64px

### Border Radius
- `sm`: 4px (badges), `DEFAULT`: 8px (buttons, cards), `md`: 12px (modals), `lg`: 16px

### Elevation
- `sm`: shadow untuk buttons/chips
- `DEFAULT`: shadow untuk cards/dropdowns
- `md`: shadow untuk elevated cards
- `lg`: shadow untuk modals

---

## Implementation Status

### Phase 1: Core Infrastructure (Prio: Critical) ✅ COMPLETE

#### 1.1 Authentication System ✅ DONE
- [x] Manual auth implementation (LoginController)
- [x] RoleMiddleware for role-based access (Admin vs Kasir)
- [x] Login/Logout untuk Admin dan Kasir
- [x] Proteksi CSRF Laravel (bawaan Laravel)

#### 1.2 Layout & Navigation ✅ DONE
- [x] `resources/views/layouts/admin.blade.php` dengan sidebar navigation lengkap
- [x] Implementasi design system (typography, colors, spacing)
- [x] Header dengan navigation dan user info
- [x] Logout functionality

#### 1.3 Table/Meja Management ✅ DONE
- [x] Migration: `tables` ditambahkan kolom `number`, `capacity`, `status`
- [x] Seeder untuk data meja awal (10 meja)
- [x] Model `Table` dengan relasi `hasMany(Order::class)`

---

### Phase 2: Modul Pemesanan - POS (Prio: High) ✅ COMPLETE

#### 2.1 Table Selection ✅ DONE
- [x] Halaman `/pos` dengan selector meja
- [x] Tampilkan daftar meja (available/occupied)
- [x] Meja occupied disabled saat dipilih cashier lain
- [x] Status meja update otomatis saat order selesai

#### 2.2 Product Filtering ✅ DONE
- [x] Category filter chips (Semua, Makanan, Minuman, Appetizer, Dessert)
- [x] Search menu dengan debounce 300ms
- [x] Chip-style category filter (sesuai design system)
- [x] Grid responsive 2-4 kolom

#### 2.3 Cart Operations ✅ DONE
- [x] Tambah item ke keranjang
- [x] Update quantity (+/-)
- [x] Hapus item dari keranjang
- [x] Tambah catatan per item ("tidak pedas", dll)
- [x] Notes field per item di cart

#### 2.4 Billing Calculation ✅ DONE
- [x] Hitung subtotal
- [x] Hitung PPN 11%
- [x] Hitung total (subtotal + PPN)
- [x] Display breakdown (Subtotal, PPN, Total)

#### 2.5 Cash Payment Flow ✅ DONE
- [x] Input nominal pembayaran
- [x] Hitung kembalian otomatis
- [x] Quick amount buttons (50k, 100k, 150k, 200k)
- [x] Validasi jika pembayaran kurang

---

### Phase 3: Modul Transaksi & Pembayaran (Prio: High) ✅ COMPLETE

#### 3.1 Billing Calculation ✅ DONE (included in Phase 2)
- [x] Hitung subtotal, PPN 11%, total
- [x] Display breakdown di cart

#### 3.2 Cash Payment Flow ✅ DONE (included in Phase 2)
- [x] Input nominal pembayaran
- [x] Hitung kembalian otomatis
- [x] Validasi jika pembayaran kurang

#### 3.3 Non-Cash Payment (Midtrans) ✅ DONE
- [x] `MidtransService.php` dengan integrasi API Snap
- [x] Route `POST /midtrans/notification` untuk webhook
- [x] `MidtransController.php` untuk handle notification
- [x] Pilihan metode pembayaran Tunai / Midtrans di modal
- [x] Redirect ke Midtrans untuk payment

#### 3.4 Receipt/Struk ✅ DONE
- [x] Install `barryvdh/laravel-dompdf`
- [x] Template struk `resources/views/pdf/receipt.blade.php`
- [x] `ReceiptController.php` dengan method `download` dan `print`
- [x] Route `/receipt/{orderId}/download` dan `/receipt/{orderId}/print`
- [x] Tombol download struk di success modal

#### 3.5 Transaction Logging ✅ DONE
- [x] Migration: `transactions` table (method, amount, change, timestamp)
- [x] Model `Transaction` dengan relasi `belongsTo(Order::class)`
- [x] Relasi `Order` -> `Transaction` (`hasOne`)

---

### Phase 4: Modul Admin - CRUD Master Data (Prio: High) ✅ COMPLETE

#### 4.1 Admin Dashboard ✅ DONE
- [x] Halaman `/admin/dashboard` (Livewire)
- [x] Overview statistik (penjualan hari ini, total order, stok rendah)
- [x] Recent orders list
- [x] Low stock products alert

#### 4.2 Product Management ✅ DONE
- [x] Halaman `/admin/products` (Livewire)
- [x] CRUD produk (nama, kategori, harga, stok)
- [x] Filter & search
- [x] Pagination

#### 4.3 Category Management ✅ DONE
- [x] Halaman `/admin/categories` (Livewire)
- [x] CRUD kategori
- [x] Product count per category

#### 4.4 Table Management ✅ DONE
- [x] Halaman `/admin/tables` (Livewire)
- [x] CRUD meja (nomor, kapasitas, status)
- [x] Visual table grid dengan status indicators

#### 4.5 User Management ✅ DONE
- [x] Halaman `/admin/users` (Livewire)
- [x] CRUD user (nama, email, password, role)
- [x] Role: Admin dan Kasir

---

### Phase 5: Modul Laporan (Prio: Medium) ✅ COMPLETE

#### 5.1 Sales Report ✅ DONE
- [x] Halaman `/admin/reports` (Livewire)
- [x] Filter tanggal (startDate, endDate)
- [x] Total penjualan, jumlah order, average order
- [x] Grafik sederhana (chart.js) - **DONE**

#### 5.2 Export Report ✅ DONE
- [x] Install `maatwebsite/excel`
- [x] Export ke Excel
- [x] Export ke PDF (dompdf sudah ada, tinggal integrate)

#### 5.3 Stock Report ✅ DONE
- [x] Laporan stok rendah (di dashboard)
- [x] Filter berdasarkan threshold

---

### Phase 6: Testing & Polish (Prio: High) ✅ COMPLETE

#### 6.1 Unit Testing ✅ DONE
- [x] Test `MidtransService.createTransaction()`
- [x] Test cart operations
- [x] Test stock decrement logic

#### 6.2 Feature Testing ✅ DONE
- [x] Test checkout flow
- [x] Test auth flow (login, logout, role protection)
- [x] Test CRUD operations

#### 6.3 Polish ✅ DONE
- [x] Flash messages (success, error, info)
- [x] Modal dialogs dengan form validation
- [x] Empty states
- [x] Loading states & skeleton UI
- [x] Responsive design check

---

## File Structure (Current)

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   └── LoginController.php       ✅
│   │   ├── ReceiptController.php         ✅ NEW
│   │   └── MidtransController.php        ✅ NEW
│   └── Middleware/
│       └── RoleMiddleware.php            ✅
├── Livewire/
│   ├── Admin/
│   │   ├── Dashboard.php                ✅
│   │   ├── Products.php                 ✅
│   │   ├── Categories.php               ✅
│   │   ├── Tables.php                   ✅
│   │   ├── Users.php                   ✅
│   │   └── Reports.php                  ✅
│   └── Pos.php                          ✅ (full update with Midtrans)
├── Services/
│   ├── MidtransService.php             ✅ NEW
│   └── TransactionService.php           ❌ (pending - can use MidtransService instead)
├── Models/
│   ├── User.php                         ✅ (+ role methods)
│   ├── Category.php                     ✅
│   ├── Product.php                      ✅
│   ├── Table.php                        ✅ (+ number, capacity, status)
│   ├── Order.php                        ✅ (+ table_id, cashier_id, order_number)
│   ├── OrderItem.php                    ✅ (+ note field)
│   └── Transaction.php                  ✅
│
resources/
├── views/
│   ├── auth/
│   │   └── login.blade.php             ✅
│   ├── layouts/
│   │   └── admin.blade.php             ✅
│   ├── pdf/
│   │   └── receipt.blade.php           ✅ NEW
│   └── livewire/
│       ├── admin/
│       │   ├── dashboard.blade.php      ✅
│       │   ├── products.blade.php      ✅
│       │   ├── categories.blade.php    ✅
│       │   ├── tables.blade.php        ✅
│       │   ├── users.blade.php         ✅
│       │   └── reports.blade.php        ✅
│       └── pos.blade.php               ✅ (with payment method selector)
│
routes/
└── web.php                              ✅ (auth + admin + receipt + Midtrans routes)

database/
├── migrations/
│   ├── 2026_05_16_000001_update_tables_table.php      ✅
│   ├── 2026_05_16_000002_update_orders_table.php      ✅
│   ├── 2026_05_16_000003_create_transactions_table.php ✅
│   ├── 2026_05_16_000004_add_role_to_users_table.php    ✅
│   └── 2026_05_16_000005_add_note_to_order_items_table.php ✅
└── seeders/
    └── DatabaseSeeder.php              ✅ (+ users, tables, products)
```

---

## Tech Stack (Telah Terinstall)

```bash
# PDF Generation
composer require barryvdh/laravel-dompdf    ✅ DONE
```

---

## Remaining Work Summary

| Phase | Task | Status |
|-------|------|--------|
| 5 | Chart/Graph di Reports | ✅ Done |
| 5 | Excel Export & PDF Export | ✅ Done |
| 6 | Unit Tests | ✅ Done |
| 6 | Feature Tests | ✅ Done |
| 6 | Loading states/Skeleton | ✅ Done |
| 6 | Responsive design check | Pending |

---

## Credentials (Development)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@dapur.com | password |
| Kasir | kasir@dapur.com | password |

---

## Catatan Konfigurasi Midtrans

Untuk mengaktifkan Midtrans, tambahkan ke `.env`:

```env
MIDTRANS_SERVER_KEY=your_server_key_from_midtrans
MIDTRANS_CLIENT_KEY=your_client_key_from_midtrans
MIDTRANS_SANDBOX=true
```

---

## Catatan

- Design system Verdana Health menggunakan navy (#0F172A) sebagai primary, bukan blue.
- Chip Filter Active: `bg-navy`, `text-white`
- Button Primary: `bg-navy`, `hover:bg-navy-800`
- Radius konsisten 8px untuk cards dan buttons
- Typography: Plus Jakarta Sans untuk heading, DM Sans untuk body