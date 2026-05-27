<?php

namespace App\Http\Controllers;

use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * MidtransController - Handles Midtrans payment notifications
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 * @see MidtransService
 */
class MidtransController extends Controller
{
    /**
     * @var MidtransService
     */
    protected MidtransService $midtransService;

    /**
     * Constructor - inject MidtransService via DI
     *
     * @param MidtransService $midtransService
     */
    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    /**
     * Handle Midtrans payment notification webhook
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function notification(Request $request): JsonResponse
    {
        $notification = $request->all();

        \Log::info('Midtrans notification received: ' . json_encode($notification));

        $result = $this->midtransService->handleNotification($notification);

        if ($result) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid notification'], 400);
    }
}