<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Orders;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Table $table;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
        $this->table = Table::create(['number' => 1, 'capacity' => 4, 'status' => 'available']);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Orders::class)
            ->assertStatus(200);
    }

    public function test_can_view_order_details(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'table_id' => $this->table->id,
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        Livewire::test(Orders::class)
            ->call('openDetail', $order->id)
            ->assertSet('showDetailModal', true)
            ->assertSet('selectedOrder.id', $order->id)
            ->assertSee('ORD-TEST-001');
    }

    public function test_can_void_paid_order(): void
    {
        $table = Table::create(['number' => 2, 'capacity' => 4, 'status' => 'occupied']);
        
        $order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'table_id' => $table->id,
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        Livewire::test(Orders::class)
            ->call('voidOrder', $order->id);

        $this->assertEquals('Voided', $order->fresh()->status);
        $this->assertEquals('available', $table->fresh()->status);
    }

    public function test_cannot_void_pending_order(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'table_id' => $this->table->id,
            'total_price' => 22200,
            'status' => 'Pending',
        ]);

        Livewire::test(Orders::class)
            ->call('voidOrder', $order->id);

        // Should still be Pending
        $this->assertEquals('Pending', $order->fresh()->status);
    }

    public function test_can_filter_by_search(): void
    {
        Order::create([
            'order_number' => 'ORD-TEST-111',
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        Order::create([
            'order_number' => 'ORD-TEST-222',
            'total_price' => 33300,
            'status' => 'Paid',
        ]);

        Livewire::test(Orders::class)
            ->set('search', '111')
            ->assertSee('ORD-TEST-111')
            ->assertDontSee('ORD-TEST-222');
    }
}
