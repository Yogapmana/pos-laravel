<?php

namespace App\Livewire\Admin;

use App\Models\Table;
use Livewire\Component;

/**
 * Tables Component - Table CRUD management for admin
 *
 * Handles create, read, update, delete operations for restaurant tables
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Tables extends Component
{
    /** @var string */
    public $number = '';

    /** @var int */
    public $capacity = 4;

    /** @var string */
    public $status = 'available';

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
            'number' => 'required|string|max:10|unique:tables,number' . ($this->editingId ? ',' . $this->editingId : ''),
            'capacity' => 'required|integer|min:1|max:20',
            'status' => 'required|in:available,occupied',
        ];
    }

    /**
     * Render the tables view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $tables = Table::orderBy('number')->get();

        return view('livewire.admin.tables', compact('tables'))
            ->layout('layouts.admin', [
                'title' => 'Meja - Dapur Bunda Bahagia',
                'headerTitle' => 'Kelola Meja',
                'headerSubtitle' => 'Kelola meja restoran',
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
            $table = Table::find($id);
            $this->editingId = $id;
            $this->number = $table->number;
            $this->capacity = $table->capacity;
            $this->status = $table->status;
        } else {
            $this->reset(['editingId', 'number', 'capacity', 'status']);
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
        $this->reset(['showModal', 'editingId', 'number', 'capacity', 'status']);
    }

    /**
     * Save table (create or update)
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        Table::updateOrCreate(
            ['id' => $this->editingId],
            [
                'number' => $this->number,
                'capacity' => $this->capacity,
                'status' => $this->status,
            ]
        );

        session()->flash('success', $this->editingId ? 'Meja berhasil diperbarui.' : 'Meja berhasil ditambahkan.');
        $this->closeModal();
    }

    /**
     * Delete a table (if no orders assigned)
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        $table = Table::find($id);
        if ($table->orders()->count() > 0) {
            session()->flash('error', 'Meja tidak bisa dihapus karena sudah memiliki transaksi.');
            return;
        }
        $table->delete();
        session()->flash('success', 'Meja berhasil dihapus.');
    }
}