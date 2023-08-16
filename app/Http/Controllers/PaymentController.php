<?php

namespace App\Http\Controllers;

use App\Exceptions\GatewayExceptions\GatewayClientException;
use App\Models\Order;
use App\Services\Gateways\GatewayInterfaceService;
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
     */
    public function purchase(Order $order)
    {
        try {
            return $this->paymentService->requestPayment($order);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 406);
        }
    }

    public function paymentSuccess(Request $request) {
        try {
            return $this->paymentService->handleCallback($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 400);
        }
    }
}
