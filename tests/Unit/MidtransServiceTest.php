<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MidtransServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaction()
    {
        Http::fake([
            'app.sandbox.midtrans.com/snap/v1/transactions' => Http::response([
                'token' => 'mock-token',
                'redirect_url' => 'http://mock-redirect.com'
            ], 201)
        ]);

        $service = new MidtransService();
        
        $order = new Order([
            'order_number' => 'TEST-123',
            'total_price' => 50000
        ]);
        // Mock cashier relationship if needed, or MidtransService should handle nulls

        $result = $service->createTransaction($order);

        $this->assertIsArray($result);
        $this->assertEquals('mock-token', $result['token']);
        $this->assertEquals('http://mock-redirect.com', $result['redirect_url']);
    }

    public function test_handles_notification_correctly()
    {
        $order = Order::create([
            'order_number' => 'ORD-TEST',
            'total_price' => 50000,
            'status' => 'Pending'
        ]);

        $service = new MidtransService();
        
        $payload = [
            'order_id' => 'ORD-TEST-xxxx',
            'transaction_status' => 'settlement',
            'payment_type' => 'gopay'
        ];

        $result = $service->handleNotification($payload);

        $this->assertTrue($result);
        $this->assertEquals('Paid', $order->fresh()->status);
    }
}
