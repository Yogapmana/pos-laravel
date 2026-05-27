# Dapur Bunda Bahagia - Restaurant Information System

Sistem Informasi Restoran berbasis Laravel dengan fitur Point of Sale (POS), manajemen stok, dan laporan penjualan.

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 13.x (PHP 8.3) |
| Frontend | Laravel Blade + Livewire 4 |
| Styling | Tailwind CSS |
| Database | SQLite (default) / MySQL |
| PDF | Barryvdh/DomPDF |
| Excel | Maatwebsite/Excel |

## Features

### Kasir (POS) - `/pos`
- Pemilih meja dengan status real-time
- Filter produk per kategori
- Search menu
- Keranjang dengan kuantitas dan catatan
- Billing otomatis (Subtotal + PPN 11%)
- Pembayaran Tunai dengan hitung kembalian
- Pembayaran Midtrans (non-tunai)
- Download struk PDF

### Admin Dashboard - `/admin/dashboard`
- Penjualan hari ini
- Jumlah order
- Produk stok rendah
- Order terbaru

### Manajemen
- **Produk** - CRUD dengan upload gambar
- **Kategori** - CRUD kategori menu
- **Meja** - CRUD meja dengan kapasitas
- **Pengguna** - CRUD user dengan role (admin/kasir)

### Laporan - `/admin/reports`
- Filter tanggal
- Total penjualan & rata-rata
- Grafik penjualan (Chart.js)
- Export Excel & PDF

## User Roles

| Role | Access |
|------|--------|
| **Admin** | Full access ke `/admin/*` |
| **Kasir** | Hanya `/pos` |

## Getting Started

### Requirements
- PHP 8.3+
- Composer
- SQLite (included) atau MySQL

### Installation

```bash
# Clone/enter project
cd dapur-bunda

# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations & seeders
php artisan migrate
php artisan db:seed

# Start development server
php artisan serve
```

### Default Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@dapur.com | password |
| Kasir | kasir@dapur.com | password |

## Project Structure

```
app/
├── Http/
│   └── Controllers/        # Auth, Receipt, Midtrans, ReportExport
├── Livewire/
│   ├── Pos.php             # POS component
│   └── Admin/             # Admin components (Dashboard, Products, etc.)
├── Models/                  # Eloquent models
└── Services/                # Business logic (MidtransService)

database/
├── migrations/            # Database schema
└── seeders/                # Sample data

resources/views/
├── layouts/                # Admin layout
├── livewire/               # Livewire views
│   ├── admin/              # Admin pages
│   └── pos.blade.php      # POS page
└── pdf/                    # Receipt template
```

## Database Schema

```
users          → id, name, email, password, role
categories    → id, name
products      → id, category_id, name, price, stock, image
tables        → id, number, capacity, status
orders        → id, order_number, table_id, cashier_id, total_price, payment_method, status
order_items   → id, order_id, product_id, price, qty, note
transactions  → id, order_id, payment_method, amount_received, change, subtotal, tax, total, status
```

## Testing

```bash
# Run all tests
php artisan test

# Or with PHPUnit
./vendor/bin/phpunit
```

## Documentation

- [PRD.md](PRD.md) - Product Requirements Document
- [Implementation_Plan.md](Implementation_Plan.md) - Implementation progress tracker
- [DESIGN.md](DESIGN.md) - Design system reference

## License

MIT