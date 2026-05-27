<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\Table;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    protected Category $category;
    protected Product $product;
    protected Table $table;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create(['name' => 'Makanan']);
        $this->table = Table::create(['number' => 1, 'capacity' => 4, 'status' => 'available']);
        $this->user = User::factory()->create();

        $this->product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);
    }

    public function test_is_pending_when_status_is_pending(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        $this->assertTrue($order->isPending());
        $this->assertFalse($order->isPaid());
    }

    public function test_is_paid_when_status_is_paid(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        $this->assertTrue($order->isPaid());
        $this->assertFalse($order->isPending());
    }

    public function test_mark_as_paid_changes_status(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        $order->markAsPaid();

        $this->assertEquals('Paid', $order->fresh()->status);
    }

    public function test_calculate_subtotal_from_items(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 2,
        ]);

        $this->assertEquals(40000, $order->calculateSubtotal());
    }

    public function test_calculate_subtotal_with_multiple_items(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 33300,
            'status' => 'Pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 2,
        ]);

        $product2 = Product::create([
            'name' => 'Es Teh',
            'price' => 5000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product2->id,
            'price' => 5000,
            'qty' => 1,
        ]);

        $this->assertEquals(45000, $order->calculateSubtotal());
    }

    public function test_calculate_tax_returns_11_percent(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
        ]);

        $tax = $order->calculateTax();

        $this->assertEquals(2200, $tax);
    }

    public function test_void_restores_stock_and_frees_table(): void
    {
        $table = Table::create(['number' => 2, 'capacity' => 4, 'status' => 'occupied']);

        $product = Product::create([
            'name' => 'Test Product',
            'price' => 15000,
            'stock' => 5,
            'category_id' => $this->category->id,
        ]);

        $order = Order::create([
            'order_number' => 'ORD-001',
            'table_id' => $table->id,
            'total_price' => 16650,
            'status' => 'Paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'price' => 15000,
            'qty' => 1,
        ]);

        // Reload relationships
        $order->refresh();
        $table->refresh();

        $result = $order->void();

        $this->assertTrue($result);
        $this->assertEquals('Voided', $order->fresh()->status);
        $this->assertEquals(6, $product->fresh()->stock);
        $this->assertEquals('available', $table->fresh()->status);
    }

    public function test_void_returns_false_if_already_voided(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'total_price' => 22200,
            'status' => 'Voided',
        ]);

        $result = $order->void();

        $this->assertFalse($result);
    }

    public function test_belongs_to_table(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'table_id' => $this->table->id,
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        $this->assertInstanceOf(Table::class, $order->table->first());
        $this->assertEquals($this->table->id, $order->table->id);
    }

    public function test_belongs_to_table_when_table_id_is_null(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-001',
            'table_id' => null,
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        $this->assertNull($order->table);
    }
}
