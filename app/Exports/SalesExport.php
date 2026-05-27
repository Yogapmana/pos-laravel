<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesExport implements FromView, ShouldAutoSize
{
    protected $start;
    protected $end;

    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public function view(): View
    {
        $dailySales = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total_price) as sales')
            ->whereBetween('created_at', [$this->start, $this->end])
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->get();

        return view('exports.sales', [
            'dailySales' => $dailySales,
            'startDate' => $this->start,
            'endDate' => $this->end,
        ]);
    }
}
