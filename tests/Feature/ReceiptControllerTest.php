<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReceiptControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Order $order;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create(['role' => 'kasir']);

        $category = Category::create(['name' => 'Makanan']);
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 25000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        $this->order = Order::create([
            'order_number' => 'ORD-20260527-0001',
            'cashier_id' => $this->user->id,
            'total_price' => 27750,
            'status' => 'Paid',
            'payment_method' => 'Tunai',
        ]);

        OrderItem::create([
            'order_id' => $this->order->id,
            'product_id' => $product->id,
            'price' => 25000,
            'qty' => 1,
        ]);

        Transaction::create([
            'order_id' => $this->order->id,
            'payment_method' => 'Tunai',
            'amount_received' => 30000,
            'change' => 2250,
            'subtotal' => 25000,
            'tax' => 2750,
            'total' => 27750,
            'status' => 'completed',
        ]);
    }

    public function test_receipt_download_requires_authentication(): void
    {
        $response = $this->get("/receipt/{$this->order->id}/download");
        $response->assertRedirect('/login');
    }

    public function test_receipt_download_returns_pdf(): void
    {
        $response = $this->actingAs($this->user)
            ->get("/receipt/{$this->order->id}/download");

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_receipt_print_requires_authentication(): void
    {
        $response = $this->get("/receipt/{$this->order->id}/print");
        $response->assertRedirect('/login');
    }

    public function test_receipt_print_returns_html(): void
    {
        $response = $this->actingAs($this->user)
            ->get("/receipt/{$this->order->id}/print");

        $response->assertStatus(200);
    }

    public function test_receipt_download_returns_404_for_invalid_order(): void
    {
        $response = $this->actingAs($this->user)
            ->get('/receipt/99999/download');

        $response->assertStatus(404);
    }

    public function test_receipt_print_returns_404_for_invalid_order(): void
    {
        $response = $this->actingAs($this->user)
            ->get('/receipt/99999/print');

        $response->assertStatus(404);
    }
}
