<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Orders Component - Order management with void functionality
 *
 * Displays list of orders with ability to view details,
 * void/cancel orders, and restore stock
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Orders extends Component
{
    use WithPagination;

    /** @var string */
    public $search = '';

    /** @var string */
    public $statusFilter = '';

    /** @var string */
    public $filterDate = '';

    /** @var bool */
    public $showDetailModal = false;

    /** @var Order|null */
    public $selectedOrder = null;

    /**
     * Reset pagination when search or filters change
     */
    public function updatingSearch() { $this->resetPage(); }
    public function updatingStatusFilter() { $this->resetPage(); }
    public function updatingFilterDate() { $this->resetPage(); }

    /**
     * Get filtered orders
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    #[Computed]
    public function orders()
    {
        return Order::with(['table', 'cashier', 'items.product'])
            ->when($this->search, fn($q) => $q->where('order_number', 'like', '%' . $this->search . '%'))
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->filterDate, fn($q) => $q->whereDate('created_at', $this->filterDate))
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    /**
     * Open order detail modal
     *
     * @param int $orderId
     * @return void
     */
    public function openDetail($orderId): void
    {
        $this->selectedOrder = Order::with(['table', 'cashier', 'items.product'])->find($orderId);
        $this->showDetailModal = true;
    }

    /**
     * Close order detail modal
     *
     * @return void
     */
    public function closeDetail(): void
    {
        $this->showDetailModal = false;
        $this->selectedOrder = null;
    }

    /**
     * Void/cancel an order and restore stock
     *
     * @param int $orderId
     * @return void
     */
    public function voidOrder($orderId): void
    {
        $order = Order::find($orderId);

        if (!$order) {
            session()->flash('error', 'Order tidak ditemukan.');
            return;
        }

        if ($order->status === Order::STATUS_VOIDED) {
            session()->flash('error', 'Order sudah pernah dibatalkan.');
            return;
        }

        if ($order->status === Order::STATUS_PENDING) {
            session()->flash('error', 'Order masih pending. Selesaikan atau hapus order pending terlebih dahulu.');
            return;
        }

        $order->void();
        session()->flash('success', 'Order ' . $order->order_number . ' berhasil dibatalkan. Stok telah dikembalikan.');
        $this->closeDetail();
    }

    /**
     * Render the orders view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.orders', [
            'orders' => $this->orders,
        ])
            ->layout('layouts.admin', [
                'title' => 'Order - Dapur Bunda Bahagia',
                'headerTitle' => 'Kelola Order',
                'headerSubtitle' => 'Lihat dan batalkan order',
            ]);
    }
}