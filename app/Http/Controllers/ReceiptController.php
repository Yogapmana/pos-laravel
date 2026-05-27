<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

/**
 * ReceiptController - Handles PDF receipt generation and download
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class ReceiptController extends Controller
{
    /**
     * Download receipt as PDF
     *
     * @param int $orderId
     * @return Response
     */
    public function download($orderId): Response
    {
        $order = Order::with(['cashier', 'table', 'items.product'])->findOrFail($orderId);
        $transaction = $order->transaction;

        $grandTotal = $order->total_price;

        $pdf = Pdf::loadView('pdf.receipt', [
            'order' => $order,
            'transaction' => $transaction,
            'grandTotal' => $grandTotal,
        ]);

        // Set thermal receipt paper size (58mm width)
        $pdf->setPaper([0, 0, 226, 600], 'portrait');

        $filename = 'struk-' . $order->order_number . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Display receipt for printing
     *
     * @param int $orderId
     * @return \Illuminate\View\View
     */
    public function print($orderId)
    {
        $order = Order::with(['cashier', 'table', 'items.product'])->findOrFail($orderId);
        $transaction = $order->transaction;

        $grandTotal = $order->total_price;

        return view('pdf.receipt', [
            'order' => $order,
            'transaction' => $transaction,
            'grandTotal' => $grandTotal,
        ]);
    }
}