<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Dashboard;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Dashboard::class)
            ->assertStatus(200);
    }

    public function test_displays_today_sales_and_orders(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        Transaction::create([
            'order_id' => $order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);

        Livewire::test(Dashboard::class)
            ->assertSet('todayOrders', 1)
            ->assertSet('todaySales', 22200);
    }

    public function test_shows_low_stock_products(): void
    {
        $category = Category::create(['name' => 'Makanan']);

        Product::create([
            'name' => 'Produk Hampir Habis',
            'price' => 10000,
            'stock' => 2,
            'category_id' => $category->id,
        ]);

        Product::create([
            'name' => 'Produk Stok Cukup',
            'price' => 10000,
            'stock' => 50,
            'category_id' => $category->id,
        ]);

        $component = Livewire::test(Dashboard::class);

        $lowStockProducts = $component->get('lowStockProducts');
        $this->assertCount(1, $lowStockProducts);
        $this->assertEquals('Produk Hampir Habis', $lowStockProducts->first()->name);
    }

    public function test_weekly_sales_has_seven_days(): void
    {
        Livewire::test(Dashboard::class)
            ->assertCount('weeklyLabels', 7)
            ->assertCount('weeklySales', 7);
    }

    public function test_kasir_cannot_access_dashboard(): void
    {
        $kasir = User::factory()->create(['role' => 'kasir']);

        $response = $this->actingAs($kasir)->get('/admin/dashboard');
        $response->assertStatus(403);
    }
}
