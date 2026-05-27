<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

/**
 * Products Component - Product CRUD management for admin
 *
 * Handles create, read, update, delete operations for menu products
 * with pagination, search, category filtering, and image upload
 *
 * @author Dapur Bunda Bahagia
 * @version 1.1
 */
class Products extends Component
{
    use WithPagination;
    use WithFileUploads;

    /** @var string */
    public $search = '';

    /** @var int|string */
    public $categoryFilter = '';

    /** @var bool */
    public $showModal = false;

    /** @var int|null */
    public $editingId = null;

    // Form fields
    /** @var string */
    public $name = '';

    /** @var int|string */
    public $category_id = '';

    /** @var string */
    public $price = '';

    /** @var string */
    public $stock = '';

    /** @var mixed */
    public $image = null;

    /** @var string|null */
    public $existingImage = null;

    /** @var string */
    protected $paginationTheme = 'tailwind';

    /**
     * Get validation rules
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // max 2MB
        ];
    }

    /**
     * Render the products view with paginated data
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $categories = Category::orderBy('name')->get();

        $products = Product::with('category')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->when($this->categoryFilter, fn($q) => $q->where('category_id', $this->categoryFilter))
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.products', compact('products', 'categories'))
            ->layout('layouts.admin', [
                'title' => 'Produk - Dapur Bunda Bahagia',
                'headerTitle' => 'Kelola Produk',
                'headerSubtitle' => 'Tambah, edit, dan hapus produk menu',
            ]);
    }

    /**
     * Open the create/edit modal
     *
     * @param int|null $id
     * @return void
     */
    public function openModal($id = null)
    {
        if ($id) {
            $this->editingId = $id;
            $product = Product::find($id);
            $this->name = $product->name;
            $this->category_id = $product->category_id;
            $this->price = $product->price;
            $this->stock = $product->stock;
            $this->existingImage = $product->image;
        } else {
            $this->reset(['editingId', 'name', 'category_id', 'price', 'stock', 'image', 'existingImage']);
        }
        $this->showModal = true;
    }

    /**
     * Close the modal and reset form
     *
     * @return void
     */
    public function closeModal()
    {
        $this->reset(['showModal', 'editingId', 'name', 'category_id', 'price', 'stock', 'image', 'existingImage']);
    }

    /**
     * Remove the currently selected image
     *
     * @return void
     */
    public function removeImage()
    {
        $this->image = null;
        $this->existingImage = null;
    }

    /**
     * Save product (create or update)
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('products', 'public');
        } elseif ($this->existingImage === null && $this->editingId) {
            // Image was explicitly removed
            $data['image'] = null;
        }

        Product::updateOrCreate(
            ['id' => $this->editingId],
            $data
        );

        session()->flash('success', $this->editingId ? 'Produk berhasil diperbarui.' : 'Produk berhasil ditambahkan.');
        $this->closeModal();
    }

    /**
     * Delete a product
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('success', 'Produk berhasil dihapus.');
    }
}