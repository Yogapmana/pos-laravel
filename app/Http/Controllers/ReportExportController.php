<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/**
 * ReportExportController - Handles report export to Excel and PDF
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class ReportExportController extends Controller
{
    /**
     * Export sales report to Excel
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Request $request)
    {
        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $filename = 'Laporan_Penjualan_' . $start->format('Ymd') . '_' . $end->format('Ymd') . '.xlsx';

        return Excel::download(new \App\Exports\SalesExport($start, $end), $filename);
    }

    /**
     * Export sales report to PDF
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function exportPdf(Request $request)
    {
        $start = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $dailySales = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total_price) as sales')
            ->whereBetween('created_at', [$start, $end])
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->get();

        $pdf = Pdf::loadView('exports.sales_pdf', [
            'dailySales' => $dailySales,
            'startDate' => $start,
            'endDate' => $end,
        ]);

        $filename = 'Laporan_Penjualan_' . $start->format('Ymd') . '_' . $end->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}