<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Products;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
        $this->category = Category::create(['name' => 'Makanan']);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Products::class)
            ->assertStatus(200);
    }

    public function test_can_create_product(): void
    {
        Livewire::test(Products::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('name', 'Nasi Goreng Baru')
            ->set('category_id', $this->category->id)
            ->set('price', 25000)
            ->set('stock', 50)
            ->call('save');

        $this->assertDatabaseHas('products', [
            'name' => 'Nasi Goreng Baru',
            'price' => 25000,
            'stock' => 50,
            'category_id' => $this->category->id,
        ]);
    }

    public function test_can_edit_product(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        Livewire::test(Products::class)
            ->call('openModal', $product->id)
            ->assertSet('editingId', $product->id)
            ->assertSet('name', 'Nasi Goreng')
            ->set('name', 'Nasi Goreng Spesial')
            ->set('price', 30000)
            ->call('save');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Nasi Goreng Spesial',
            'price' => 30000,
        ]);
    }

    public function test_can_delete_product(): void
    {
        $product = Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        Livewire::test(Products::class)
            ->call('delete', $product->id);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_validation_requires_name(): void
    {
        Livewire::test(Products::class)
            ->call('openModal')
            ->set('name', '')
            ->set('category_id', $this->category->id)
            ->set('price', 25000)
            ->set('stock', 10)
            ->call('save')
            ->assertHasErrors(['name']);
    }

    public function test_validation_requires_valid_category(): void
    {
        Livewire::test(Products::class)
            ->call('openModal')
            ->set('name', 'Test')
            ->set('category_id', 99999)
            ->set('price', 25000)
            ->set('stock', 10)
            ->call('save')
            ->assertHasErrors(['category_id']);
    }

    public function test_can_filter_by_search(): void
    {
        Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $this->category->id,
        ]);

        Product::create([
            'name' => 'Es Teh',
            'price' => 5000,
            'stock' => 50,
            'category_id' => $this->category->id,
        ]);

        Livewire::test(Products::class)
            ->set('search', 'Nasi')
            ->assertSee('Nasi Goreng')
            ->assertDontSee('Es Teh');
    }

    public function test_close_modal_resets_form(): void
    {
        Livewire::test(Products::class)
            ->call('openModal')
            ->set('name', 'Test')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('name', '')
            ->assertSet('editingId', null);
    }
}
