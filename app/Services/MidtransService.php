<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MidtransService
{
    protected $serverKey;
    protected $clientKey;
    protected $isSandbox;
    protected $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY'));
        $this->clientKey = config('services.midtrans.client_key', env('MIDTRANS_CLIENT_KEY'));
        $this->isSandbox = config('services.midtrans.sandbox', true);
        $this->baseUrl = $this->isSandbox
            ? 'https://app.sandbox.midtrans.com'
            : 'https://app.midtrans.com';
    }

    public function isConfigured(): bool
    {
        return !empty($this->serverKey) && !empty($this->clientKey);
    }

    public function createTransaction(Order $order): ?array
    {
        if (!$this->isConfigured()) {
            return null;
        }

        $transactionData = [
            'transaction_details' => [
                'order_id' => $order->order_number . '-' . Str::random(6),
                'gross_amount' => (int) $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->cashier?->name ?? 'Kasir',
                'email' => $order->cashier?->email ?? 'kasir@dapur.com',
            ],
            'item_details' => $this->buildItemDetails($order),
            'callbacks' => [
                'finish' => url('/pos?status=success&db_order_id=' . $order->id),
            ],
        ];

        try {
            $response = Http::withBasicAuth($this->serverKey, '')
                ->post($this->baseUrl . '/snap/v1/transactions', $transactionData);

            if ($response->successful()) {
                return [
                    'token' => $response->json('token'),
                    'redirect_url' => $response->json('redirect_url'),
                ];
            }
        } catch (\Exception $e) {
            \Log::error('Midtrans error: ' . $e->getMessage());
        }

        return null;
    }

    protected function buildItemDetails(Order $order): array
    {
        $items = [];
        foreach ($order->items as $item) {
            $items[] = [
                'id' => (string) $item->product_id,
                'price' => (int) $item->price,
                'quantity' => (int) $item->qty,
                'name' => $item->product?->name ?? 'Item',
            ];
        }
        // Add tax as separate item
        $items[] = [
            'id' => 'TAX',
            'price' => (int) round($order->total_price * 0.11 / 1.11),
            'quantity' => 1,
            'name' => 'PPN (11%)',
        ];
        return $items;
    }

    public function handleNotification(array $payload): ?bool
    {
        $orderId = $payload['order_id'] ?? null;
        $transactionStatus = $payload['transaction_status'] ?? null;
        $paymentType = $payload['payment_type'] ?? null;

        if (!$orderId || !$transactionStatus) {
            return null;
        }

        // Extract original order number
        $originalOrderId = preg_replace('/-[a-zA-Z0-9]+$/', '', $orderId);

        $order = Order::where('order_number', $originalOrderId)->first();
        if (!$order) {
            return null;
        }

        $statusMap = [
            'capture' => 'completed',
            'settlement' => 'completed',
            'pending' => 'pending',
            'deny' => 'failed',
            'expire' => 'failed',
            'cancel' => 'failed',
        ];

        $status = $statusMap[$transactionStatus] ?? 'pending';

        // Update transaction if exists
        $transaction = $order->transaction;
        if ($transaction) {
            $transaction->update([
                'midtrans_order_id' => $orderId,
                'midtrans_payment_type' => $paymentType,
                'status' => $status,
            ]);
        }

        // Update order status
        if ($status === 'completed') {
            $order->update(['status' => 'Paid']);
        }

        return true;
    }

    public function getRedirectionUrl(?string $token): ?string
    {
        if (!$token) {
            return null;
        }
        return $this->baseUrl . '/snap/v2/token/' . $token . '/redirect';
    }
}