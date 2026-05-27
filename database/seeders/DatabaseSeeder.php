<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Admin Default
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@dapur.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Default',
            'email' => 'kasir@dapur.com',
            'password' => bcrypt('password'),
            'role' => 'kasir',
        ]);

        // 2. Buat Kategori
        $makanan = Category::create(["name" => "Makanan"]);
        $minuman = Category::create(["name" => "Minuman"]);
        $appetizer = Category::create(["name" => "Appetizer"]);
        $dessert = Category::create(["name" => "Dessert"]);

        // 3. Buat Meja
        for ($i = 1; $i <= 10; $i++) {
            $num = str_pad($i, 2, '0', STR_PAD_LEFT);
            Table::create([
                'number' => $num,
                'capacity' => $i <= 4 ? 6 : 4,
                'status' => 'available',
            ]);
        }

        // 4. Buat Produk
        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Nasi Goreng Spesial',
            'price' => 25000,
            'stock' => 50,
        ]);
        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Ayam Bakar Madu',
            'price' => 32000,
            'stock' => 25,
        ]);
        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Sate Ayam',
            'price' => 28000,
            'stock' => 30,
        ]);
        Product::create([
            'category_id' => $makanan->id,
            'name' => 'Rendang Daging',
            'price' => 35000,
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Es Teh Manis',
            'price' => 5000,
            'stock' => 100,
        ]);
        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Es Jeruk',
            'price' => 6000,
            'stock' => 80,
        ]);
        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Kopi Hitam',
            'price' => 8000,
            'stock' => 60,
        ]);
        Product::create([
            'category_id' => $minuman->id,
            'name' => 'Jus Alpukat',
            'price' => 12000,
            'stock' => 25,
        ]);

        Product::create([
            'category_id' => $appetizer->id,
            'name' => 'Kentang Goreng',
            'price' => 15000,
            'stock' => 40,
        ]);
        Product::create([
            'category_id' => $appetizer->id,
            'name' => 'Pisang Goreng',
            'price' => 12000,
            'stock' => 35,
        ]);
        Product::create([
            'category_id' => $appetizer->id,
            'name' => 'Tempura Sayuran',
            'price' => 18000,
            'stock' => 20,
        ]);

        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Es Krim Vanila',
            'price' => 15000,
            'stock' => 30,
        ]);
        Product::create([
            'category_id' => $dessert->id,
            'name' => 'Puding Coklat',
            'price' => 10000,
            'stock' => 25,
        ]);
    }
}