<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Pos;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PosTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create(['role' => 'kasir']);
        $this->actingAs($this->user);
        
        $this->category = Category::create(['name' => 'Test Category']);
    }

    public function test_renders_successfully()
    {
        Livewire::test(Pos::class)
            ->assertStatus(200);
    }

    public function test_can_add_product_to_cart()
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id
        ]);

        Livewire::test(Pos::class)
            ->call('addToCart', $product->id)
            ->assertSet('subtotal', 20000)
            ->assertSet('tax', (int) round(20000 * 0.11))
            ->assertSet('grandTotal', 20000 + (int) round(20000 * 0.11));
    }

    public function test_can_increment_and_decrement_qty()
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 10000,
            'stock' => 10,
            'category_id' => $this->category->id
        ]);

        Livewire::test(Pos::class)
            ->call('addToCart', $product->id)
            ->call('incrementQty', $product->id)
            ->assertSet('subtotal', 20000)
            ->call('decrementQty', $product->id)
            ->assertSet('subtotal', 10000);
    }

    public function test_cannot_add_out_of_stock_product()
    {
        $product = Product::create([
            'name' => 'Habis',
            'price' => 10000,
            'stock' => 0,
            'category_id' => $this->category->id
        ]);

        Livewire::test(Pos::class)
            ->call('addToCart', $product->id)
            ->assertSet('subtotal', 0);
    }

    public function test_can_process_cash_payment()
    {
        $product = Product::create([
            'name' => 'Es Teh',
            'price' => 10000,
            'stock' => 10,
            'category_id' => $this->category->id
        ]);
        
        $table = Table::create([
            'number' => 1,
            'capacity' => 4,
            'status' => 'available'
        ]);

        $grandTotal = 10000 + (int) round(10000 * 0.11);

        Livewire::test(Pos::class)
            ->call('selectTable', $table->id)
            ->call('addToCart', $product->id)
            ->set('paymentMethod', 'Tunai')
            ->set('paymentAmount', $grandTotal + 5000) // pay more
            ->call('processPayment')
            ->assertSet('showSuccessModal', true)
            ->assertSet('lastOrderTotal', $grandTotal);

        // Assert database
        $this->assertDatabaseHas('orders', [
            'table_id' => $table->id,
            'total_price' => $grandTotal,
            'status' => 'Paid'
        ]);
        
        // Assert stock decremented
        $this->assertEquals(9, $product->fresh()->stock);
    }
}
