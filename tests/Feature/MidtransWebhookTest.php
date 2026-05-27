<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidtransWebhookTest extends TestCase
{
    use RefreshDatabase;

    public function test_webhook_endpoint_bypasses_csrf_protection(): void
    {
        $response = $this->postJson('/midtrans/notification', [
            'order_id' => 'ORD-FAKE-abc123',
            'transaction_status' => 'settlement',
        ]);

        // Should NOT return 419 (CSRF mismatch) — proves CSRF exclusion works
        $this->assertNotEquals(419, $response->status());
    }

    public function test_webhook_updates_order_to_paid_on_settlement(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-20260527-0001',
            'total_price' => 55500,
            'status' => 'Pending',
            'payment_method' => 'Midtrans',
        ]);

        Transaction::create([
            'order_id' => $order->id,
            'payment_method' => 'Midtrans',
            'amount_received' => 0,
            'change' => 0,
            'subtotal' => 50000,
            'tax' => 5500,
            'total' => 55500,
            'status' => 'pending',
        ]);

        $response = $this->postJson('/midtrans/notification', [
            'order_id' => 'ORD-20260527-0001-abc123',
            'transaction_status' => 'settlement',
            'payment_type' => 'gopay',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertEquals('Paid', $order->fresh()->status);
        $this->assertEquals('completed', $order->fresh()->transaction->status);
    }

    public function test_webhook_marks_transaction_failed_on_deny(): void
    {
        $order = Order::create([
            'order_number' => 'ORD-20260527-0002',
            'total_price' => 30000,
            'status' => 'Pending',
            'payment_method' => 'Midtrans',
        ]);

        Transaction::create([
            'order_id' => $order->id,
            'payment_method' => 'Midtrans',
            'amount_received' => 0,
            'change' => 0,
            'subtotal' => 27027,
            'tax' => 2973,
            'total' => 30000,
            'status' => 'pending',
        ]);

        $response = $this->postJson('/midtrans/notification', [
            'order_id' => 'ORD-20260527-0002-xyz456',
            'transaction_status' => 'deny',
            'payment_type' => 'credit_card',
        ]);

        $response->assertStatus(200);

        $this->assertEquals('failed', $order->fresh()->transaction->status);
        // Order should remain Pending when denied (not marked as Paid)
        $this->assertEquals('Pending', $order->fresh()->status);
    }

    public function test_webhook_returns_400_for_invalid_notification(): void
    {
        $response = $this->postJson('/midtrans/notification', [
            'order_id' => 'NONEXISTENT-ORDER',
            'transaction_status' => 'settlement',
        ]);

        $response->assertStatus(400)
            ->assertJson(['success' => false]);
    }

    public function test_webhook_returns_400_when_missing_required_fields(): void
    {
        $response = $this->postJson('/midtrans/notification', []);

        $response->assertStatus(400)
            ->assertJson(['success' => false]);
    }
}
