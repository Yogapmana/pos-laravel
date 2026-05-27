<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Transaction;
use Carbon\Carbon;
use Livewire\Component;

/**
 * Reports Component - Sales report view with filters and chart
 *
 * Displays sales data with date range filtering, statistics,
 * daily sales table, and bar chart visualization
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Reports extends Component
{
    /** @var string */
    public $startDate;

    /** @var string */
    public $endDate;

    /** @var string */
    public $reportType = 'daily';

    /** @var int */
    public $totalSales = 0;

    /** @var int */
    public $totalOrders = 0;

    /** @var int */
    public $averageOrder = 0;

    /**
     * Get validation rules
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'reportType' => 'required|in:daily,weekly,monthly',
        ];
    }

    /**
     * Initialize report with current month date range
     *
     * @return void
     */
    public function mount(): void
    {
        $this->startDate = Carbon::today()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::today()->format('Y-m-d');
        $this->loadReport();
    }

    /**
     * Reload report when filters change
     *
     * @param string $property
     * @return void
     */
    public function updated(string $property): void
    {
        if (in_array($property, ['startDate', 'endDate', 'reportType'])) {
            $this->loadReport();
        }
    }

    /**
     * Load report data based on date range
     *
     * @return void
     */
    public function loadReport(): void
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->endOfDay();

        $orders = Order::whereBetween('created_at', [$start, $end])->get();

        $this->totalOrders = $orders->count();
        $this->totalSales = Transaction::whereBetween('created_at', [$start, $end])
            ->where('status', 'completed')
            ->sum('total');
        $this->averageOrder = $this->totalOrders > 0 ? $this->totalSales / $this->totalOrders : 0;
    }

    /**
     * Render the reports view with chart data
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->endOfDay();

        $dailySales = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total_price) as sales')
            ->whereBetween('created_at', [$start, $end])
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        $chartData = [
            'labels' => $dailySales->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'))->toArray(),
            'values' => $dailySales->pluck('sales')->toArray(),
        ];

        // Best selling products aggregated in database for performance
        $bestSellingProducts = \App\Models\OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->where('orders.status', '!=', Order::STATUS_VOIDED)
            ->selectRaw('
                COALESCE(products.name, "Produk dihapus") as name,
                SUM(order_items.qty) as total_qty,
                SUM(order_items.price * order_items.qty) as total_revenue
            ')
            ->groupBy('order_items.product_id', 'products.name')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        return view('livewire.admin.reports', compact('dailySales', 'chartData', 'bestSellingProducts'))
            ->layout('layouts.admin', [
                'title' => 'Laporan - Dapur Bunda Bahagia',
                'headerTitle' => 'Laporan Penjualan',
                'headerSubtitle' => 'Lihat dan export laporan penjualan',
            ]);
    }
}