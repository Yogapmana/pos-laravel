<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->category = Category::create(['name' => 'Makanan']);
    }

    public function test_is_out_of_stock_when_stock_is_zero(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 0,
            'category_id' => $this->category->id,
        ]);

        $this->assertTrue($product->isOutOfStock());
    }

    public function test_is_not_out_of_stock_when_stock_is_positive(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        $this->assertFalse($product->isOutOfStock());
    }

    public function test_is_low_stock_when_stock_is_5_or_less(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 3,
            'category_id' => $this->category->id,
        ]);

        $this->assertTrue($product->isLowStock());
    }

    public function test_is_not_low_stock_when_stock_is_greater_than_5(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        $this->assertFalse($product->isLowStock());
    }

    public function test_is_not_low_stock_when_stock_is_zero(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 0,
            'category_id' => $this->category->id,
        ]);

        $this->assertFalse($product->isLowStock());
    }

    public function test_decrement_stock_succeeds_when_sufficient(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        $result = $product->decrementStock(3);

        $this->assertTrue($result);
        $this->assertEquals(7, $product->fresh()->stock);
    }

    public function test_decrement_stock_fails_when_insufficient(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 2,
            'category_id' => $this->category->id,
        ]);

        $result = $product->decrementStock(5);

        $this->assertFalse($result);
        $this->assertEquals(2, $product->fresh()->stock);
    }

    public function test_belongs_to_category(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        $this->assertInstanceOf(Category::class, $product->category->first());
        $this->assertEquals($this->category->id, $product->category->id);
    }
}
