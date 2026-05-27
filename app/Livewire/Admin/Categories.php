<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;

/**
 * Categories Component - Category CRUD management for admin
 *
 * Handles create, read, update, delete operations for product categories
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Categories extends Component
{
    /** @var string */
    public $name = '';

    /** @var int|null */
    public $editingId = null;

    /** @var bool */
    public $showModal = false;

    /**
     * Get validation rules
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name' . ($this->editingId ? ',' . $this->editingId : ''),
        ];
    }

    /**
     * Render the categories view with product counts
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('livewire.admin.categories', compact('categories'))
            ->layout('layouts.admin', [
                'title' => 'Kategori - Dapur Bunda Bahagia',
                'headerTitle' => 'Kelola Kategori',
                'headerSubtitle' => 'Kelola kategori menu restoran',
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
            $this->name = Category::find($id)->name;
        } else {
            $this->reset(['editingId', 'name']);
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
        $this->reset(['showModal', 'editingId', 'name']);
    }

    /**
     * Save category (create or update)
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        Category::updateOrCreate(
            ['id' => $this->editingId],
            ['name' => $this->name]
        );

        session()->flash('success', $this->editingId ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');
        $this->closeModal();
    }

    /**
     * Delete a category (if no products assigned)
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $category = Category::find($id);
        if ($category->products()->count() > 0) {
            session()->flash('error', 'Kategori tidak bisa dihapus karena masih memiliki produk.');
            return;
        }
        $category->delete();
        session()->flash('success', 'Kategori berhasil dihapus.');
    }
}