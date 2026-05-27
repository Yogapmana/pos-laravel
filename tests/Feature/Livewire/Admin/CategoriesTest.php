<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Categories;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoriesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Categories::class)
            ->assertStatus(200);
    }

    public function test_can_create_category(): void
    {
        Livewire::test(Categories::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('name', 'Makanan Berat')
            ->call('save');

        $this->assertDatabaseHas('categories', ['name' => 'Makanan Berat']);
    }

    public function test_can_edit_category(): void
    {
        $category = Category::create(['name' => 'Minuman']);

        Livewire::test(Categories::class)
            ->call('openModal', $category->id)
            ->assertSet('editingId', $category->id)
            ->assertSet('name', 'Minuman')
            ->set('name', 'Minuman Segar')
            ->call('save');

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Minuman Segar',
        ]);
    }

    public function test_can_delete_empty_category(): void
    {
        $category = Category::create(['name' => 'Kategori Kosong']);

        Livewire::test(Categories::class)
            ->call('delete', $category->id);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_cannot_delete_category_with_products(): void
    {
        $category = Category::create(['name' => 'Makanan']);

        Product::create([
            'name' => 'Nasi Goreng',
            'price' => 20000,
            'stock' => 10,
            'category_id' => $category->id,
        ]);

        Livewire::test(Categories::class)
            ->call('delete', $category->id);

        // Category should still exist
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }

    public function test_validation_requires_unique_name(): void
    {
        Category::create(['name' => 'Makanan']);

        Livewire::test(Categories::class)
            ->call('openModal')
            ->set('name', 'Makanan')
            ->call('save')
            ->assertHasErrors(['name']);
    }

    public function test_validation_requires_name(): void
    {
        Livewire::test(Categories::class)
            ->call('openModal')
            ->set('name', '')
            ->call('save')
            ->assertHasErrors(['name']);
    }

    public function test_close_modal_resets_form(): void
    {
        Livewire::test(Categories::class)
            ->call('openModal')
            ->set('name', 'Test')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('name', '')
            ->assertSet('editingId', null);
    }
}
