<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Gateways\GatewayInterfaceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected GatewayInterfaceService $paymentService;

    /**
     * @param GatewayInterfaceService $paymentService
     */
    public function __construct(GatewayInterfaceService $paymentService)
    {
        $this->paymentService = $paymentService;
    }


    /**
     * Purchase an order
     * @param Order $order
     * @return JsonResponse
     */
    public function purchase(Order $order): \Illuminate\Http\JsonResponse
    {
        try {
            return $this->paymentService->requestPayment($order);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 406);
        }
    }

    public function paymentStatus(Request $request) {
        try {
            return $this->paymentService->handleCallback($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }
}
