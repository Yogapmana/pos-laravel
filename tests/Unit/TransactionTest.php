<?php

namespace Tests\Unit;

use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    protected Order $order;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->order = Order::create([
            'order_number' => 'ORD-TEST-001',
            'total_price' => 22200,
            'status' => 'Pending',
        ]);
    }

    public function test_is_pending_when_status_is_pending(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'pending',
        ]);

        $this->assertTrue($transaction->isPending());
        $this->assertFalse($transaction->isCompleted());
    }

    public function test_is_completed_when_status_is_completed(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);

        $this->assertTrue($transaction->isCompleted());
        $this->assertFalse($transaction->isPending());
    }

    public function test_mark_as_completed_changes_status(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'pending',
        ]);

        $transaction->markAsCompleted();

        $this->assertEquals('completed', $transaction->fresh()->status);
    }

    public function test_is_cash_payment_when_method_is_tunai(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);

        $this->assertTrue($transaction->isCashPayment());
        $this->assertFalse($transaction->isMidtransPayment());
    }

    public function test_is_midtrans_payment_when_method_is_midtrans(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Midtrans',
            'amount_received' => 22200,
            'change' => 0,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);

        $this->assertTrue($transaction->isMidtransPayment());
        $this->assertFalse($transaction->isCashPayment());
    }

    public function test_belongs_to_order(): void
    {
        $transaction = Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 25000,
            'change' => 2800,
            'subtotal' => 20000,
            'tax' => 2200,
            'total' => 22200,
            'status' => 'completed',
        ]);

        $this->assertInstanceOf(Order::class, $transaction->order->first());
        $this->assertEquals($this->order->id, $transaction->order->id);
    }
}
