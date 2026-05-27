<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Reports;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReportsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);

        $category = Category::create(['name' => 'Makanan']);
        $this->product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Reports::class)
            ->assertStatus(200);
    }

    public function test_loads_report_data_correctly(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'total_price' => 22200,
            'status' => 'Paid',
            'created_at' => Carbon::today(),
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
            'created_at' => Carbon::today(),
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
            'created_at' => Carbon::today(),
        ]);

        Livewire::test(Reports::class)
            ->assertSet('totalOrders', 1)
            ->assertSet('totalSales', 22200)
            ->assertSet('averageOrder', 22200);
    }

    public function test_filters_report_by_date(): void
    {
        // Order from yesterday
        $orderYesterday = Order::create([
            'order_number' => 'ORD-TEST-001',
            'total_price' => 22200,
            'status' => 'Paid',
        ]);
        $orderYesterday->created_at = Carbon::yesterday();
        $orderYesterday->save(['timestamps' => false]);

        $transactionYesterday = Transaction::create([
            'order_id' => $orderYesterday->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);
        $transactionYesterday->created_at = Carbon::yesterday();
        $transactionYesterday->save(['timestamps' => false]);

        // Order from today
        $orderToday = Order::create([
            'order_number' => 'ORD-TEST-002',
            'total_price' => 33300,
            'status' => 'Paid',
            'created_at' => Carbon::today(),
        ]);

        Transaction::create([
            'order_id' => $orderToday->id,
            'payment_method' => 'Tunai',
            'amount_received' => 35000,
            'change' => 1700,
            'subtotal' => 30000,
            'tax' => 3300,
            'total' => 33300,
            'status' => 'completed',
            'created_at' => Carbon::today(),
        ]);

        // Filter for yesterday only
        Livewire::test(Reports::class)
            ->set('startDate', Carbon::yesterday()->format('Y-m-d'))
            ->set('endDate', Carbon::yesterday()->format('Y-m-d'))
            ->assertSet('totalOrders', 1)
            ->assertSet('totalSales', 22200);
    }
}
