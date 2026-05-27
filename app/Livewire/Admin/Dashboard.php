<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;

/**
 * Dashboard Component - Admin dashboard overview
 *
 * Displays today's sales, order count, low stock alerts,
 * and recent orders for admin monitoring
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Dashboard extends Component
{
    /** @var int */
    public $todaySales = 0;

    /** @var int */
    public $todayOrders = 0;

    /** @var Collection<int, Product> */
    public $lowStockProducts = [];

    /** @var Collection<int, Order> */
    public $recentOrders = [];

    /** @var int */
    public $stockThreshold = 5;

    /** @var array<string, int> */
    public $weeklySales = [];

    /** @var array<string> */
    public $weeklyLabels = [];

    /**
     * Initialize dashboard data
     *
     * @return void
     */
    public function mount(): void
    {
        // Today's sales (completed transactions)
        $this->todaySales = \App\Models\Transaction::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->sum('total');

        // Today's orders count
        $this->todayOrders = Order::whereDate('created_at', Carbon::today())->count();

        // Low stock products
        $this->loadLowStock();

        // Recent orders
        $this->recentOrders = Order::with(['table', 'cashier', 'items'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Weekly sales for chart
        $this->loadWeeklySales();
    }

    /**
     * Load weekly sales data for chart
     *
     * @return void
     */
    public function loadWeeklySales(): void
    {
        $labels = [];
        $sales = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('D');
            $sales[] = (int) \App\Models\Transaction::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum('total');
        }

        $this->weeklyLabels = $labels;
        $this->weeklySales = $sales;
    }

    /**
     * Reload low stock when threshold changes
     *
     * @return void
     */
    public function updatedStockThreshold(): void
    {
        $this->loadLowStock();
    }

    /**
     * Load products with low stock
     *
     * @return void
     */
    public function loadLowStock(): void
    {
        $this->lowStockProducts = Product::where('stock', '<=', $this->stockThreshold ?: 0)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();
    }

    /**
     * Render the dashboard view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin', [
                'title' => 'Dashboard - Dapur Bunda Bahagia',
                'headerTitle' => 'Dashboard',
                'headerSubtitle' => 'Ringkasan aktivitas restoran',
            ]);
    }
}