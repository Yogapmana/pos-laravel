<?php

namespace Tests\Unit;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    use RefreshDatabase;

    protected Category $category;
    protected Product $product;
    protected Order $order;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create(['name' => 'Makanan']);

        $user = User::factory()->create();

        $this->product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        $this->order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);
    }

    public function test_get_subtotal_calculates_price_times_quantity(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 2,
        ]);

        $this->assertEquals(40000, $item->getSubtotal());
    }

    public function test_get_subtotal_with_single_quantity(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 15000,
            'qty' => 1,
        ]);

        $this->assertEquals(15000, $item->getSubtotal());
    }

    public function test_has_note_returns_true_when_note_exists(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
            'note' => 'Tidak pedas',
        ]);

        $this->assertTrue($item->hasNote());
    }

    public function test_has_note_returns_false_when_note_is_null(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
        ]);

        $this->assertFalse($item->hasNote());
    }

    public function test_has_note_returns_false_when_note_is_empty(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
            'note' => '',
        ]);

        $this->assertFalse($item->hasNote());
    }

    public function test_belongs_to_product(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
        ]);

        $this->assertInstanceOf(Product::class, $item->product->first());
        $this->assertEquals($this->product->id, $item->product->id);
    }

    public function test_belongs_to_order(): void
    {
        $item = OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $this->product->id,
            'price' => 20000,
            'qty' => 1,
        ]);

        $this->assertInstanceOf(Order::class, $item->order->first());
        $this->assertEquals($this->order->id, $item->order->id);
    }
}
